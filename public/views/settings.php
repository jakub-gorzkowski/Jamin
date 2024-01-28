<?php
require_once 'src/controllers/SessionController.php';
$sessionController = new SessionController();
if(!$sessionController->checkSession()) {
    header("Location: /login");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/style/global.css">
        <link rel="stylesheet" href="public/style/settings.css">
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
            <div id="change-password-container">
                <form class="change-password" action="change_password" method="POST" ENCTYPE="multipart/form-data">
                    <div class="messages">
                        <?php
                        if (isset($messages)) {
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <input type="password" name="old-password" placeholder="Current password"> <br/>
                    <input type="password" name="new-password" placeholder="New password"> <br/>
                    <input type="password" name="new-password-confirmed" placeholder="Confirm new password"> <br/>
                    <button type="submit">Change password</button>
                </form>
            </div>
        </div>

        <div class="logout-container">
            <form class="logout" action="logout" method="POST">
                <button type="submit">Log out</button>
            </form>
        </div>

    </body>
</html>