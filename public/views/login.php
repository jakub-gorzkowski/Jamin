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
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="login-container">
                <h1>login</h1>
                <form class="login" action="login" method="POST">
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
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>