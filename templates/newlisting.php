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
            <div class="topbar"> <!-- this section includes the site's title and navigation bar -->
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
                <div class="profile"> <!-- the user's profile picture -->
                    <a href="yourlistings.html">
                        <img class="profile" src="../images/profile.png" alt="logo">
                    </a>
                </div>
            </header>
        </div>
        
        <main>
            <h1>Listing Information</h1>

            <div class="modal">
                <label for="Name">Listing Title:</label>
                <input type="text" id="Title" name="Title" placeholder="Four-Bedroom Apartment">
                <label for="Name">Listing Description:</label>
                <input type="text" id="Description" name="Description" placeholder="Located in Charlottesville, Virginia with a pool and in-unit washer/dryer.">

                <div class="bottomhalf">
                    <p id="addr">City of Charlottesville
                        PO Box 911
                        Charlottesville, VA 22902</p>
            <div class="container">
                <div class="d">
                    <table class="amenities">
                        <tr>                    
                            <th>Amenities</th>
                        </tr>
                        <tr>                    
                            <td>pool</td>
                        </tr>                    
                        <tr>                    
                            <td>parking</td>
                        </tr>                    
                        <tr>                    
                            <td>washer</td>
                        </tr>                    
                        <tr>                    
                            <td>dryer</td>
                        </tr>
                    </table>
                    

                </div>

                <div class="d">
                    <table class="amenities">
                        <tr>                    
                            <th>Amenities</th>
                        </tr>
                        <tr>                    
                            <td>pool</td>
                        </tr>                    
                        <tr>                    
                            <td>parking</td>
                        </tr>                    
                        <tr>                    
                            <td>washer</td>
                        </tr>                    
                        <tr>                    
                            <td>dryer</td>
                        </tr>
                    </table>     
                </div>

                <div class="d">
                    <table class="pbb">
                        <tr>                    
                            <td>Rent Price: $1750/month</td>
                        </tr>                    
                        <tr>                    
                            <td># Bathrooms: 4</td>
                        </tr>                    
                        <tr>                    
                            <td># Bedrooms: 4</td>
                        </tr>                    

                    </table>
                </div>
            </div>
                </div>


            <div class="actions">
                <a href="yourlistings.html">
                    <button type="button">Back</button>
                </a> 
            </div>
            <div class="actions">
                <a href="yourlistings.html">
                    <button type="button">Done</button>
                </a> 
            </div>
            </div>
            
        </main>
       
        <div>
            <footer class="primary-footer">
                <small class="copyright">&copy; 2023 Shreya Nagabhirava. All rights reserved.</small>
            </footer>
        </div>
     </body>
 </html>