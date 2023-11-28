<?php
    function add_listing($dbHandle, $title, $addr, $desc, $rent, $bath, $bed, $image, $rating, $amens, $author){
         echo $author;
        $r = pg_prepare($dbHandle, "s", "insert into listing (title, addr, dsc, rent, num_bath, num_bed, image, rating, amenities, author_id) values ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10);");
        $r = pg_execute($dbHandle, "s", [$title, $addr, $desc, $rent, $bath, $bed, $image, $rating, $amens, $author]);
    }

    function get_listings($dbHandle){
        $r = pg_query_params($dbHandle, "select * from listing", []);
        return json_encode(pg_fetch_all($r));
    }

    function get_user_listing($dbHandle, $email){
        $r = pg_query_params($dbHandle. "select * from person p inner join listing l 
                                            on p.email=l.author_id where p.email=$1", [$email]);
        return json_encode(pg_fetch_all($r));
    }
?>