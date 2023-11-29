<?php
    require("/opt/src/CS4640-Project/db/add_listing_db.php");

    $listings = json_decode(get_listings($dbHandle), true);

?>

<!DOCTYPE html>
 <html lang="en">
     <head>
        <link rel="stylesheet" href="../styles/main.css"> <!-- link to the main.css style sheet -->
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1"> 

         <meta name="author" content="Shreya Nagabhirava and Fardeen Khan">
         <meta name="description" content="Apartment Search and Review">
         <meta name="keywords" content="Apartment Search and Apartment Review">
        <title>Apartment Search and Review</title>
        <!-- deployed version: https://cs4640.cs.virginia.edu/ffk9uu/project/search.html -->
        <style>
            #validationMessage {
                font-weight: bold;
                margin: 10px;
                background-color: #ffcccc;
                padding: 10px;
                display: none;
            }
        </style>
        <script>
            function validateSearch() {
                var input = document.getElementById("city").value;
                var validationMessage = document.getElementById("validationMessage");
                validationMessage.textContent = '';

                if (input !== "") {
                    var regex = /^([A-Za-z]+|[A-Za-z\s]+,\s[A-Za-z]+)$/;
                    if (regex.test(input)) {
                        sessionStorage.setItem("citySearch", input);
                        validationMessage.textContent = "This is a valid search.";
                        // validationMessage.style.background-color = #7cfc00;
                    } else {
                        validationMessage.textContent = "Please enter a city in either the format Charlottesville or Charlottesville, Virginia.";
                    }
                } else {
                    validationMessage.textContent = "Please enter a city in either the format Charlottesville or Charlottesville, Virginia.";
                }
                validationMessage.style.display = validationMessage.textContent.trim() !== "" ? "block" : "none";
            }
        </script>
    </head>  
     <body style="background-color:white">
        <div class="topbar">
            <div class="title">
                <span>Apartment Search and Review</span>
            </div>
            <div class="nav-container">
                <nav>
                    <ul class="nav-list">
                        <li><form action="?command=search" method="post"><button type="submit">Search</button></form></li>
                        <li><form action="?command=newListing" method="post"><button type="submit">New Listing</button></form></li>
                        <li><form action="?command=myListing" method="post"><button type="submit">My Listings</button></form></li>
                    </ul>
                </nav>
            </div>
        </div>
        <header>
            <div class="logo"> <!-- this is the site's logo -->
                <img src="../images/logo.png" alt="apartment search logo">
            </div>
            <form method="post">
                <div class="searchbar"> <!-- this search bar allows users to search for a specific location and find apartments there -->
                    <input type="search" class="form-control" name="location" id="city" placeholder="City, State">
                    <button type="submit" class="btn btn-primary" onclick="validateSearch(); return false;">Search</button>
                </div>
            </form>
            
            <div class="profile"> <!-- the user's profile picture -->
                <a href="yourlistings.html">
                    <img class="profile" src="../images/profile.png" alt="logo">
                </a>
            </div>
        </header>
        <div id="validationMessage"></div>
        <div class="user-selections">
            <div class="rooms-dropdown"> <!-- user's can choose how many bedrooms they want their apartment search to have -->
                <label for="bedrooms">Bedrooms:</label>
                <select name="rooms-number" id="bedrooms">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5+">5+</option>
                </select>
            </div>
            <div class="rent-dropdown"> <!-- user's can choose their preferred rent -->
                <label for="rent">Rent/Month:</label>
                <select name="rent" id="rent">
                    <option value="500">Less Than 500</option>
                    <option value="1000">Less Than 1000</option>
                    <option value="1500">Less Than 1500</option>
                    <option value="2000">Less Than 2000</option>
                    <option value="2500">Less Than 2500</option>
                    <option value="2500+">2500+</option>
                </select>
            </div>
            <div class="amenities-dropdown"> <!-- user's can choose their preferred amenities -->
                <label for="amenities">Amenities:</label>
                <select name="amenities"  id="amenities" >
                    <option value="A/C">A/C</option>
                    <option value="Heating">Heating</option>
                    <option value="Dishwasher">Dishwasher</option>
                    <option value="Washer">Washer</option>
                    <option value="Dryer">Dryer</option>
                    <option value="Gym">Gym</option>
                    <option value="Pool">Pool</option>
                </select>
            </div>
            <div class="rating-dropdown"> <!-- user's can choose their preferred average rating -->
                <label for="rating">Average Rating:</label>
                <select name="rating" id="rating" >
                    <option value="1">Greater Than 1</option>
                    <option value="2">Greater Than 2</option>
                    <option value="3">Greater Than 3</option>
                    <option value="4">Greater Than 4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <div class="apartments">
            <div class="first-row">
                <?php
                    // print_r($listings[0]);

                    foreach($listings as $l){
                        echo '<div class="response">';
                            echo '<img class="listingimg" src="images/condo-vs-apartment.jpeg.webp" alt="apartment pic">';
                            echo '<p class="title">'.$l['title'].'</p>';
                            echo '<p class="title">Rent: $'.$l['rent'].' # Bed: '.$l['num_bed'].' # Bath: '.$l['num_bath'].'</p>';
                            echo '<p class="locn">'.$l['addr'].'</p>';
                            echo '<p>* _ _ _ _</p>';
                            echo '<p class="list-desc">Description: '.$l['dsc'].'</p>';
                            echo '<p class="list-desc">Amenities: '.$l['amenities'].'</p>';
                        echo '</div>';
                    }
                ?>
                <!-- <div class="response">
                    <p class="title">4 bedroom apartment</p>
                    <p class="locn">Charlottesville, VA</p>
                    <p>* _ _ _ _</p>
                    <p class="list-desc">Description, pets allowed, pool access</p>
                </div> -->
            </div>
        </div>
        <br>
        <div>
            <footer class="primary-footer">
                <small class="copyright">&copy; 2023 Shreya Nagabhirava. All rights reserved.</small>
            </footer>
        </div>
     </body>
 </html>