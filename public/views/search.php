<?php
require_once 'src/controllers/SessionController.php';
require_once 'src/repository/UserRepository.php';
$userRepository = new UserRepository();
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
                <div class="nav-button"><a href="home"><i class="fa-solid fa-house"></i>&nbsp<div>Home</div></a></div>
                <div class="nav-button"><a href="followed"><i class="fa-solid fa-eye"></i> &nbsp<div>Followed</div></a></div>
                <div class="nav-button"><a href="search" class="current-section"><i class="fa-solid fa-magnifying-glass"></i> &nbsp<div>Search</div></a></div>
                <div class="nav-button"><a href="settings"><i class="fa-solid fa-gear"></i> &nbsp<div>Settings</div></a></div>
                <?php
                if ($userRepository->getRole($_SESSION['user_email']) === "admin") {
                ?>
                    <div class="nav-button"><a href="add_content"><i class="fa-solid fa-plus"></i> <div>Upload</div></a></div>
                <?php
                }
                ?>
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
                    <button class="follow-button" type="button"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
        </div>

        <script>
            function changeButtonText(button) {
                if (followForm.getAttribute('action') === 'follow') {
                    document.getElementById('followForm').setAttribute('action', 'follow');
                } else {
                    document.getElementById('followForm').setAttribute('action', 'unfollow');
                }
            }
        </script>
    </template>
</html>