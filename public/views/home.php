<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/style/global.css">
        <script src="https://kit.fontawesome.com/2069fca16b.js" crossorigin="anonymous"></script>
        <title>Home</title>
    </head>
    <body>
        <nav>
            <div id="logo-container">
                <img src="public/images/Jamin.png" alt="Jamin">
            </div>
            <div id="nav-button-container">
                <div class="nav-button"><a href="home" class="current-section"><i class="fa-solid fa-house"></i> Home</a></div>
                <div class="nav-button"><a href="followed"><i class="fa-solid fa-eye"></i> Followed</a></div>
                <div class="nav-button"><a href="search"><i class="fa-solid fa-magnifying-glass"></i> Search</a></div>
                <div class="nav-button"><a href="settings"><i class="fa-solid fa-gear"></i> Settings</a></div>
            </div>
        </nav>

        <div id="promoted-events">
            <h1>Promoted events</h1>
        </div>

        <div id="recommended-events"> 
            <h1>Recommended for you</h1>
            
        </div>

        <div id="content-container">
            <img src="public/uploads/<?= $event->getImage() ?>">
            <h2><?= $event->getTitle() ?></h2>
            <p><?= $event->getDescription() ?></p>
        </div>
    </body>
</html>
