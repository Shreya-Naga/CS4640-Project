<?php

class Controller {

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
        $command = "showLogin";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        if($command == "showLogin") {
            $this->showLogin();
        }
        elseif($command == "login") {
            $this->login();
        }
        elseif($command == "validateSearch") {
            $this->validateSearch();
        }
        elseif($command == "logout") {
            $this->logout();
        }
        else {
            $this->showLogin();
        }
        
        // switch($command) {
        //     case "showLogin":
        //         echo "Hello Show Login";
        //     case "login":
        //         echo "Hello Login";

        //         $this->login();
        //     case "validateSearch":
        //         echo "Hello search";

        //         $this->validateSearch();
        //     case "logout":
        //         echo "Hello logout";

        //         $this->logout();
        // };
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

        if(isset($_POST["name"])) {
            $_SESSION["name"] = $_POST["name"];
        }
        $this->showSearch();
    }

    public function validateSearch() {
        $message = "";
        if (isset($_POST["location"])) {
            if (preg_match("^([A-Za-z]+|[A-Za-z\s]+,\s[A-Za-z]+)$^", $_POST["location"])) {
                $_SESSION["city"] = $_POST["location"];
                $message =  "This is a valid search.";
            }
            else {
                $message = "Please enter a city in either the format Charlottesville or Charlottesville, Virginia.";
            }
        }
        $_SESSION['searchMessage'] = $message;
        include("templates/search.php");        
    }

    public function showSearch() {
        $message = "";
        include("templates/search.php");        
    }

    /**
     * Log out the user
     */
     public function logout() {
        session_destroy();
        session_start();
    }

}
