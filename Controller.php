<?php

class Controller {

    private $categories = [];

    private $input = [];

    /**
     * Constructor
     */
    public function __construct($input) {
        session_start();
        $this->input = $input;
    }

    /**
     * Run the server
     *
     * Given the input (usually $_GET), then it will determine
     * which command to execute based on the given "command"
     * parameter.  Default is the welcome page.
     */
    public function run() {
        // Get the command
        $command = "welcome";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch($command) {
            case "login":
                $this->login();
            case "categories":
                $this->loadCategoryList();
                break;
            case "answer":
                $this->answer();
                break;
            case "gameOver":
                $this->showGameOver();
            case "logout":
                $this->logout();
            default:
                $this->showWelcome();
                break;
        }
    }

     /**
     * Show the welcome page to the user.
     */
    public function showLogin() {
        include("templates/login.php");
    }

    /**
     * Handle user registration and log-in
     */
    public function login() {

        if(isset($_POST["fullname"])) {
            $_SESSION["name"] = $_POST["fullname"];
        }

        if(isset($_POST["email"])) {
            $_SESSION["email"] = $_POST["email"];
        }

        $_SESSION["guesses"] = 0;
    }

    /**
     * Load categories from a URL, store them as an array
     * in the current object.
     */
    public function loadCategoryList() {
        $this->categories = json_decode(
            file_get_contents("http://www.cs.virginia.edu/~jh2jf/data/categories.json"), true);

        if (empty($this->categories)) {
            die("Something went wrong loading categories");
        }
        else {
            $this->getFourCategories();
        }
    }

    /**
     * Get four categories
     * 
     * By default, it returns a random question's id and text.  If given
     * a question id, it returns that question's text and answer.
     */
    public function getFourCategories() {

        shuffle($this->categories);

        $fourCategories = array_slice($this->categories, 0, 4);
        $words = array();
        $shuffledWords = array();

        $_SESSION["categories"] = $fourCategories;
        foreach($fourCategories as $category) {
            foreach($category['words'] as $word) {
                $words[] = $word;
                $shuffledWords[] = $word;
            }
        }
        //randomize the words
        shuffle($shuffledWords);
        $_SESSION['shuffledWords'] = $shuffledWords; 
        $_SESSION['words'] = $words;
        $_SESSION['previousGuesses'] = array();  
    
        $this->showCategories();
    }

    /**
     * Show a question to the user.  This function loads a
     * template PHP file and displays it to the user based on
     * properties of this object.
     */
    public function showCategories($message = "") {
        $name = $_SESSION["name"];
        $email = $_SESSION["email"];
        $guesses = $_SESSION["guesses"];
        $categories = $_SESSION['categories'];
        $words = $_SESSION['words'];
        $shuffledWords = $_SESSION['shuffledWords'];
        $previousGuesses = $_SESSION['previousGuesses'];
        include("templates/game.php");
    }

   

    /**
     * Check the user's answer to a question.
     */
    public function answer() {
        $message = "";
        $_SESSION["guesses"]++;

        //if (isset($_POST["answer"]) && isset($_POST["originalArray"]) && isset($_POST["shuffledArray"])) {
            
            $fourCategories = $_SESSION["categories"];
            $shuffledWords = $_SESSION['shuffledWords'];
            $words = $_SESSION['words'];

            $answer = explode(" ", trim($_POST['answer']));
            $answer = array_unique($answer);

            if (!(count($answer) == 4)) {
                $message = "<div class=\"alert alert-danger\" role=\"alert\">
                Incorrect number of guesses given! </div>";
            }
            else {
                $size = 4;
                $guessedCategories= array(); 
                for ($i = 0; $i < $size; $i++) {
                    $guessedCategories[] = 0;  
                }
                foreach($answer as $num){
                    $shuffledIndex = (int)$num - 1;
                    if ($shuffledIndex < count($shuffledWords) && $shuffledIndex >= 0) {
                        $guessedWord = $shuffledWords[$shuffledIndex];
                        $_SESSION['previousGuesses'][] = $guessedWord;
                        $originalIndex = array_search($guessedWord, $words);
                        $guessedCategories[intdiv($originalIndex, 4)]++;
                    }
                }
                #find the max number from here, not just any of them
                foreach($guessedCategories as $count) {
                    if ($count == 2) {
                        $message = "<div class=\"alert alert-danger\" role=\"alert\">You guessed two words that are not a part of the category.</div>";
                        break;
                    }
                    if ($count == 3) {
                        $message = "<div class=\"alert alert-danger\" role=\"alert\">You guessed one words that is not a part of the category.</div>";
                        break;
                    }
                    if ($count == 4) {
                        $message = "<div class=\"alert alert-success\" role=\"alert\">You guessed this category correctly!</div>";
                        break;
                    }
                }
                if ($message == "") {
                    $message = "<div class=\"alert alert-danger\" role=\"alert\">Your guess did not contain enough words from any category.</div>";
                }
            }

        //}
        $this->showCategories($message);
    }

    public function showGameOver() {
        $name = $_SESSION["name"];
        $email = $_SESSION["email"];
        $guesses = $_SESSION["guesses"];
        $categories = $_SESSION['categories'];
        include("templates/gameOver.php");
    }

    /**
     * Log out the user
     */
     public function logout() {
        session_destroy();
        session_start();
    }

}
