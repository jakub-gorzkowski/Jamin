<?php
require_once 'src/controllers/SessionController.php';
$sessionController = new SessionController();
if(!$sessionController->checkSession()) {
    header("Location: /login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/style/global.css">
        <link rel="stylesheet" href="public/style/search.css">
        <script src="https://kit.fontawesome.com/2069fca16b.js" crossorigin="anonymous"></script>
        <title>Search</title>
    </head>
    <body>
        <nav>
            <div id="logo-container">
                <img src="public/images/Jamin.png" alt="Jamin">
            </div>
            <div id="nav-button-container">
                <div class="nav-button"><a href="home"><i class="fa-solid fa-house"></i> Home</a></div>
                <div class="nav-button"><a href="followed"><i class="fa-solid fa-eye"></i> Followed</a></div>
                <div class="nav-button"><a href="search" class="current-section"><i class="fa-solid fa-magnifying-glass"></i> Search</a></div>
                <div class="nav-button"><a href="settings"><i class="fa-solid fa-gear"></i> Settings</a></div>
            </div>
        </nav>
        <div class="section-container"> 
            <div id="search-bar-container">
                <form action="" method="get">
                    <input type="text" id="search-bar" name="search" placeholder="Search...">
                    <button type="submit" id="search-button"><i class="fa-solid fa-play"></i></button>
                </form>
            </div>

            <div id="filters-container">
                <div class="row">
                    <label for="location">Location</label>
                    <input type="text" id="location" placeholder="Location"><br />
                </div>

                <div class="row">
                    <label for="category">Category</label>
                    <input type="text" id="category" placeholder="Category"><br />
                </div>
            
                <div class="row">
                    <label for="priceRange">Price range</label>
                    <input type="number" class="price-range" placeholder="Min Price"> -
                    <input type="number" class="price-range" placeholder="Max Price"><br />
                </div>

                <div class="row">
                    <label for="date">Date</label>
                    <input type="date" id="date"><br />
                </div>

                <button onclick="" id="apply-filters">Apply Filters</button>
            </div>
        </div>
        
        <div class="section-container"> 
            <div class="section-header-container">
                <h2>Results</h2>
            </div>
            <div class="recommended-event">
                <div class="image-container">
                    <img src="public/uploads/example.jpg" alt="event-image">
                </div>
                <div class="information-container">
                    <div class="event-name">
                        <h3>Event name</h3>
                    </div>
                    <div class="description">
                        <article>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</article>
                    </div>
                    <div class="details-container">
                        <div class="location"><i class="fa-solid fa-location-dot"></i> Location</div>
                        <div class="category"><i class="fa-solid fa-table-cells"></i> Category</div>
                        <div class="price-range"><i class="fa-solid fa-money-bill-1-wave"></i> 20-60€</div>
                        <button class="follow-button" type="button">Follow</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>