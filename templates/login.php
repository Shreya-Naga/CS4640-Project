<?php

    require("/opt/src/CS4640-Project/db/login_db.php");
    // require("../../src/CS4640-Project/db/login_db.php");
    $authAttempt = 0;
    $wrong_credential_msg = "";
    $username_exists_msg = "";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(!empty($_POST['actionBtn']) && $_POST['actionBtn']=="LOGIN"){
            $auth = check_login($dbHandle, $_POST['name'], $_POST['password']);
            $authAttempt = 1;
            if($authAttempt){
                if($auth){
                    echo $_POST['name'];
                    $_SESSION['name'] = $_POST['name']; 
                    $wrong_credential_msg = "";
                    header("Location: http://localhost:8080/project/?command=search");
                    exit();
                } else{
                    $wrong_credential_msg = "invalid creds";
                }
            }
        }
        if (!empty($_POST['actionBtn']) && $_POST['actionBtn']=="REGISTER"){
                $lookup = check_exist_username($dbHandle, $_POST['name']);

                if($lookup){
                    $username_exists_msg="user exists";
                }else{
                    add_user($dbHandle, $_POST['name'], $_POST['password']);
                    $_SESSION['name'] = $_POST['name'];
                    $username_exists_msg = "";
                    header("Location: http://localhost:8080/project/?command=search");
                    exit();
                }
        }
    }
    
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="your name">
        <meta name="description" content="include some description about your page">     
        <title>Apartment Finder</title> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>

    <body style="background-color:lightskyblue">
        <div class="shadow rounded-3 mx-auto w-50" style="background-color:white; margin-top:10%;">
            <h2 class="mt-3 pt-4 text-center">Apartment Finder Login</h2>
            <form action="?command=login" name="mainForm" method="post" class="mt-5 px-2"> 
                <div class="row mb-3 mx-3" style="color:lightskyblue">
                    Username:
                    <input type="text" class="form-control" id="name" name="name" required />    
                </div>  
                <div class="row mb-3 mx-3" style="color:lightskyblue">
                    Password:
                    <input type="password" class="form-control" id="password" name="password" required />        
                </div>  
                <div class="mt-5 pb-4 mx-auto w-75 d-flex justify-content-evenly">
                    <input type="submit" class="btn btn-primary mx-auto" value="LOGIN" name="actionBtn" title="Login">
                    <input type="submit" class="btn btn-primary mx-auto" value="REGISTER" name="actionBtn" title="Register">
                </div>

                <p class="text-center fw-bold pb-3" style="color:red">
                    <?php if($wrong_credential_msg != "") echo $wrong_credential_msg; ?>
                    <?php if($username_exists_msg != "") echo $username_exists_msg; ?>   
                </p> 
            </form>     
        </div>    
    </body>
</html>