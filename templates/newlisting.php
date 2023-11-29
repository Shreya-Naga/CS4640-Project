<?php
    require("/opt/src/CS4640-Project/db/add_listing_db.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(!empty($_POST['actionBtn'])){
            if($_POST['actionBtn']=="Submit Listing"){
                $author_id = $_SESSION['name'];
                echo $author_id;
                $title = $_POST['Title'];
                $desc = $_POST['Description'];
                $addr = $_POST['Address'];
                $amenities = $_POST['amenities'];
                $rent = $_POST['rent'];
                $bath = $_POST['bath'];
                $bed = $_POST['bed'];
                $rating = null;
                $image = null;
                add_listing($dbHandle, $title, $addr, $desc, $rent, $bath, $bed, $image, $rating, $amenities, $author_id);
                header("Location: ?command=search");
                // exit();
            }else if($_POST['actionBtn']=="Exit"){
                echo "Asdfasdfasdfasdfsdaf";
                header("Location: ?command=search");
                // exit();
            }
        }
    }

?>


<!DOCTYPE html>
 <html lang="en">
     <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1"> 

         <meta name="author" content="Shreya Nagabhirava and Fardeen Khan">
         <meta name="description" content="info page">
         <meta name="keywords" content="info page">
        <title>Add Listing</title>
        <link rel="stylesheet" href="../styles/listinfo.css">

        <script>
            // make the title input box dynamically increase in size based on the users input
            document.addEventListener("DOMContentLoaded", function () {
                
                var titleInput = document.getElementById('Title');

                titleInput.addEventListener('input', function() {
                    titleInput.style.width = (titleInput.value.length + 1) * 8 + 'px';
                });

            });
            // make the description input box dynamically increase in size based on the users input
            document.addEventListener("DOMContentLoaded", function () {
                
                var descriptionInput = document.getElementById('Description');

                descriptionInput.addEventListePner('input', function() {
                    descriptionInput.style.width = (descriptionInput.value.length + 1) * 10 + 'px';
                });

            });
        </script>
     </head>  
     <body>
        <div>
            <div class="topbar">
                <div class="title">
                    <span>Apartment Search and Review</span>
                </div>
                <div class="nav-container">
                    <nav>
                        <ul class="nav-list">
                            <li><a href="search.php">Apartment Search</a></li>
                            <li><a href="yourlistings.html">My Profile</a></li>
                            <li><a href="yourlistings.html">My Listings</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <header>
                <a href="search.html">
                    <div class="logo">
                        <img src="../images/logo.png" alt="apartment search logo">
                    </div>
                </a>
                <div class="profile">
                    <a href="yourlistings.html">
                        <img class="profile" src="../images/profile.png" alt="logo">
                    </a>
                </div>
            </header>
        </div>
        
        <main>
            <h1>Listing Information</h1>

            <div class="modal">
                <form method="POST">
                    <label for="Name">Listing Title:</label>
                    <input type="text" id="Title" name="Title" placeholder="Four-Bedroom Apartment">
                    <label for="Name">Listing Description:</label>
                    <input type="text" id="Description" name="Description" placeholder="Located in Charlottesville, Virginia with a pool and in-unit washer/dryer.">

                    <div class="bottomhalf">
                        <label for="addr">Listing Address</label>
                        <input type="text" id="addr" name="Address" placeholder="City of Charlottesville, PO Box 911, Charlottesville, VA 22902">
                        <div class="container">
                            <div class="d">
                                <label for="amenities">Amenities</label>
                                <textarea id="amenities" name="amenities" rows="4" cols="50">List Amenities</textarea>
                            </div>

                            <div class="d">
                                <table class="pbb">
                                    <tr>                    
                                        <td>
                                            <label for="price">Rent Price:</label>    
                                            <input type="text" name="rent" placeholder="$/month">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="bath"># Bathrooms:</label>    
                                            <input type="text" name="bath" placeholder="bathrooms">
                                        </td>
                                    </tr>                    
                                    <tr>                    
                                        <td>
                                            <label for="bed"># Bedrooms:</label>    
                                            <input type="text" name="bed" placeholder="bedrooms">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="actions"> -->
                        <!-- <a href="yourlistings.html">
                            <button type="button">Back</button>
                        </a>  -->
                    <input type="submit" class="sbmt" value="Submit Listing" name="actionBtn" title="Submit">
                    <input type="submit" value="Exit" name="actionBtn" title="Exit">
                        <!-- <a href="yourlistings.html">
                            <button type="button">Done</button>
                        </a>  -->
                    <!-- </div> -->
                </form>
            </div>
            
        </main>
       
        <div>
            <footer class="primary-footer">
                <small class="copyright">&copy; 2023 Shreya Nagabhirava. All rights reserved.</small>
            </footer>
        </div>
     </body>
 </html>