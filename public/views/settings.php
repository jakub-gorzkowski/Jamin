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
            <?php
            require_once 'src/repository/OptionRepository.php';
            require_once 'src/repository/UserRepository.php';
            require_once 'src/models/Option.php';
            $userRepository = new UserRepository();
            $optionRepository = new OptionRepository();
            $options = $optionRepository->getOptions("locations");
            ?>
            <div class="messages">
                <?php
                if (isset($messages)) {
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <div>
                <form action="add_location" method="POST" ENCTYPE="multipart/form-data">
                    <input type="hidden" value="<?= $userRepository->getUserId($_SESSION['user_email']) ?>" name="user-id">
                    <select name="location-id">
                        <?php foreach ($options as $option): ?>
                            <option value="<?php echo $option->getId(); ?>"><?php echo $option->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Add</button>
                </form>
            </div>

            <div>
                <form action="remove_location" method="POST" ENCTYPE="multipart/form-data">
                    <input type="hidden" value="<?= $userRepository->getUserId($_SESSION['user_email']) ?>" name="user-id">
                    <select name="location-id">
                        <?php foreach ($options as $option): ?>
                            <option value="<?php echo $option->getId(); ?>"><?php echo $option->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Remove</button>
                </form>
            </div>
            <div>
                <form action="add_category" method="POST" ENCTYPE="multipart/form-data">
                    <?php
                    $optionRepository = new OptionRepository();
                    $options = $optionRepository->getOptions("categories");
                    ?>
                    <input type="hidden" value="<?= $userRepository->getUserId($_SESSION['user_email']) ?>" name="user-id">
                    <select name="category-id">
                        <?php foreach ($options as $option): ?>
                            <option value="<?php echo $option->getId(); ?>"><?php echo $option->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Add</button>
                </form>
            </div>
            <div>
                <form action="remove_category" method="POST" ENCTYPE="multipart/form-data">
                    <input type="hidden" value="<?= $userRepository->getUserId($_SESSION['user_email']) ?>" name="user-id">
                    <select name="category-id">
                        <?php foreach ($options as $option): ?>
                            <option value="<?php echo $option->getId(); ?>"><?php echo $option->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Remove</button>
                </form>
            </div>
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