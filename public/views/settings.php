<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/style/global.css">
        <script src="https://kit.fontawesome.com/2069fca16b.js" crossorigin="anonymous"></script>
        <title>Settings</title>
    </head>
    <body>
        <nav>
            <div id="logo-container">
                <img src="public/images/Jamin.png" alt="Jamin">
            </div>
            <div id="nav-button-container">
                <div class="nav-button"><a href="home"><i class="fa-solid fa-house"></i> Home</a></div>
                <div class="nav-button"><a href="followed"><i class="fa-solid fa-eye"></i> Followed</a></div>
                <div class="nav-button"><a href="search"><i class="fa-solid fa-magnifying-glass"></i> Search</a></div>
                <div class="nav-button"><a href="settings" class="current-section"><i class="fa-solid fa-gear"></i> Settings</a></div>
            </div>
        </nav>

        <div class="preferences-container">

        </div>

        <div class="settings-container">

        </div>

        <div class="logout-container">
            <form class="logout" action="logout" method="POST">
                <button type="submit">Log out</button>
            </form>
        </div>

    </body>
</html>