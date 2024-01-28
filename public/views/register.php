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
        <link rel="stylesheet" href="/public/style/register.css">
        <script src="/public/js/validate.js" type="text/javascript" defer></script>
        <title>Register</title>
    </head>
    <body>
        <h1>register</h1>
        <form class="register" action="register" method="POST">
            <div class="messages">
                <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                ?>
            </div>
            <input name="email" type="text" placeholder="email address"> <br/>
            <input name="password" type="password" placeholder="password"> <br/>
            <input name="confirmed-password" type="password" placeholder="confirm password"> <br/>
            <button type="submit">Register</button>
        </form>
    </body>
</html>