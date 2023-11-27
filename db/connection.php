<?php

function connect(){
    $host = "db";
    $port = "5432";
    $database = "example";
    $user = "localuser";
    $password = "cs4640LocalUser!"; 

    $db = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");
    return $db;

    echo "asdfdasf";
    if ($dbHandle) {
        echo "Success connecting to database";
    } else {
        echo "An error occurred connecting to the database";
    }

}