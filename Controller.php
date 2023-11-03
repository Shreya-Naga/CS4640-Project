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
        $command = "login";
        if (isset($this->input["command"]))
            $command = $this->input["command"];

        switch($command) {
            case "login":
                $this->login();
            case "search":
                $this->showSearch();
            case "logout":
                $this->logout();
            default:
                $this->showLogin();
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

        if(isset($_POST["name"])) {
            $_SESSION["name"] = $_POST["name"];
        }

        $_SESSION["guesses"] = 0;
    }

    public function validateSearch() {
        if (isset($_POST["search"])) {
            if ($_POST["search"] == "^([A-Za-z]+|[A-Za-z\s]+,\s[A-Za-z]+)$") {
                $_SESSION["city"] = $_POST["search"];
            }
            else {
                echo "Please enter a city in either the format Charlottesville or Charlottesville, Virginia.";
            }
        }
    }

    public function showSearch() {
        $name = $_SESSION["name"];
        include("search.php");        
    }

    /**
     * Log out the user
     */
     public function logout() {
        session_destroy();
        session_start();
    }

}
