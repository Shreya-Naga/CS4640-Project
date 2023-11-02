<?php
    function add_listing($title, $addr, $desc, $rent, $bath, $bed, $image, $rating, $amens, $author){
        global $dbHandle;
        $r = pg_prepare($dbHandle, "s", "insert into public.listing
                                    (title, addr, desc, rent, num_bath, num_bed, image, rating, amenities, author_id)
                                    VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9, $10);");
        $r = pg_execute($dbHandle, "s", [$title, $addr, $desc, $rent, $bath, $bed, $image, $rating, $amens, $author]);
    }
?>