<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/style/global.css">
        <link rel="stylesheet" href="public/style/followed.css">
        <script src="https://kit.fontawesome.com/2069fca16b.js" crossorigin="anonymous"></script>
        <title>Followed</title>
    </head>
    <body>
        <nav>
            <div id="logo-container">
                <img src="public/images/Jamin.png" alt="Jamin">
            </div>
            <div id="nav-button-container">
                <div class="nav-button"><a href="home"><i class="fa-solid fa-house"></i> Home</a></div>
                <div class="nav-button"><a href="followed" class="current-section"><i class="fa-solid fa-eye"></i> Followed</a></div>
                <div class="nav-button"><a href="search"><i class="fa-solid fa-magnifying-glass"></i> Search</a></div>
                <div class="nav-button"><a href="settings"><i class="fa-solid fa-gear"></i> Settings</a></div>
            </div>
        </nav>

        <div class="section-container"> 
            <div class="section-header-container">
                <h2>Upcoming</h2>
                <button class="show-all">Show all</button>
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
                        <button class="follow-button" type="button">Unfollow</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-container"> 
            <div class="section-header-container">
                <h2>Past events</h2>
                <button class="show-all">Show all</button>
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
                        <button class="follow-button" type="button">Unfollow</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>