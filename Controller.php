<?php
// require("/opt/src/CS4640-Project/db/connection.php");
require("db/connection.php");

class Controller {

    private $connector;
    private $input = [];
    private $user_id = "";

    public function __construct($input) {
        session_start();
        $host = Config::$db["host"];
        $user = Config::$db["user"];
        $database = Config::$db["database"];
        $password = Config::$db["pass"];
        $port = Config::$db["port"];

    
        $this->connector = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");
        $this->input = $input;
    
    }

    public function run() {
        // Get the command
        $command = "login";
        if (isset($this->input["command"])){
            $command = $this->input["command"];
        }

        switch($command) {
            case "login":
                $this->showLogin();
                break;
            case "search":
                $this->showSearch();
                break;
            case "newListing":
                $this->newListing();
                break;
            case "validateSearch":
                $this->validateSearch();
                break;
            case "logout":
                $this->logout();
                break;
            default:
                $this->showLogin();
                break;
        }
    }


    public function showLogin() {
        $dbHandle = $this->connector;
        include("templates/login.php");
    }

    public function newListing(){
        $dbHandle = $this->connector;
        include("templates/newlisting.php");

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

    public function showSearch($message="") {
        $name = $_SESSION["name"];
        $dbHandle = $this->connector;
        include("templates/search.php");        
    }

     public function logout() {
        session_destroy();
        session_start();
    }

}
