<?php

if($_SERVER['REQUEST_METHOD']=="GET"){
    get_similar_listings($dbHandle, $_GET['query']);
}

function get_similar_listings($dbHandle, $query){
    $r = pg_query_params($dbHandle, "select * from listing where addr like '%' || $1 || '%';", [$query]);
    $res = json_encode(pg_fetch_all($r));
    echo $res;
    return $res;
}