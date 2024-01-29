<?php
require_once 'src/controllers/SessionController.php';
$sessionController = new SessionController();
if($sessionController->checkSession()) {
    header("Location: /home");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/public/style/global.css">
        <link rel="stylesheet" href="/public/style/authentication.css">
        <script src="https://kit.fontawesome.com/2069fca16b.js" crossorigin="anonymous"></script>
        <script src="/public/js/validate.js" type="text/javascript" defer></script>
        <title>Register</title>
    </head>
    <body>
        <nav>
            <div id="logo-container">
                <img src="public/images/Jamin.png" alt="Jamin">
            </div>
            <div id="nav-button-container">
                <div class="nav-button"><a href="" class="current-section"><i class="fa-solid fa-house"></i>&nbsp<div>Home</div></a></div>
                <div class="nav-button"><a href="" class="current-section"><i class="fa-solid fa-eye"></i> &nbsp<div>Followed</div></a></div>
                <div class="nav-button"><a href="" class="current-section"><i class="fa-solid fa-magnifying-glass"></i> &nbsp<div>Search</div></a></div>
                <div class="nav-button"><a href="" class="current-section"><i class="fa-solid fa-gear"></i> &nbsp<div>Settings</div></a></div>
            </div>
        </nav>
        <div class="authentication-container">
            <h1>Create an account</h1>
            <form class="register" action="register" method="POST">
                <input name="email" type="text" placeholder="email address"> <br/>
                <input name="password" type="password" placeholder="password"> <br/>
                <input name="confirmed-password" type="password" placeholder="confirm password"> <br/>
                <button type="submit">Register</button>
                <div class="messages">
                    <?php
                        if (isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
            </form>
        </div>
    </body>
</html>