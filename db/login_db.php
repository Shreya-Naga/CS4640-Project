<?php
    function add_user($dbHandle, $email, $pwd){
        $r = pg_prepare($dbHandle, "s", "insert into person (email, password) values ($1, crypt($2, gen_salt('bf')));");
        $r = pg_execute($dbHandle, "s", [$email, $pwd]);
    }

    function check_exist_username($dbHandle, $email){
        $r = pg_query_params($dbHandle, "select * from person where email=$1;", [$email]);
        return pg_fetch_all($r);
    }

    function check_login($dbHandle, $email, $password){
        $r = pg_query_params($dbHandle, "select email from person where email=$1 and password=crypt($2, person.password);", [$email, $password]);
        $a = pg_fetch_all($r);
        return $a;
    }
?>