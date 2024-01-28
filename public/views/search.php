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
        <script type="text/javascript" src="./public/js/search.js" defer></script>
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
                <input type="text" id="search-bar" name="search" placeholder="Search">
                <button type="submit" id="search-button"><i class="fa-solid fa-play"></i></button>
            </div>
        </div>

        <div class="section-container" ">
            <div class="section-header-container">
                <h2 style="opacity: 0;">Results</h2>
            </div>
            <div class="output">

            </div>
        </div>
    </body>
    <template id="event-template">
        <div class="recommended-event">
            <div class="image-container">
                <img src="" alt="event-image">
            </div>
            <div class="information-container">
                <div class="event-name">
                    <h3>Event name</h3>
                </div>
                <div class="description">
                    <article>description</article>
                </div>
                <div class="details-container">
                    <div class="location"><i class="fa-solid fa-location-dot"></i> &nbsp;<div class="location-content"> location</div></div>
                    <div class="category"><i class="fa-solid fa-table-cells"></i> &nbsp;<div class="category-content"> category</div></div>
                    <div class="price-range"><i class="fa-solid fa-money-bill-1-wave"></i> <div class="min-price">20</div>-<div class="max-price">60</div></div>
                    <button class="follow-button" type="button">Follow</button>
                </div>
            </div>
        </div>
    </template>
</html>