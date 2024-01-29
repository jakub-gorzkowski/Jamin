<?php
require_once 'src/controllers/SessionController.php';
require_once 'src/repository/UserRepository.php';
$sessionController = new SessionController();
$userRepository = new UserRepository();
if(!$sessionController->checkSession()) {
    header("Location: /login");
    exit();
}

if ($userRepository->getRole($_SESSION['user_email']) !== "admin") {
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
        <link rel="stylesheet" href="/public/style/upload.css">
        <script src="https://kit.fontawesome.com/2069fca16b.js" crossorigin="anonymous"></script>
        <title>Upload</title>
    </head>
    <body>
        <nav>
            <div id="logo-container">
                <img src="public/images/Jamin.png" alt="Jamin">
            </div>
            <div id="nav-button-container">
                <div class="nav-button"><a href="home"><i class="fa-solid fa-house"></i>&nbsp<div>Home</div></a></div>
                <div class="nav-button"><a href="followed"><i class="fa-solid fa-eye"></i> &nbsp<div>Followed</div></a></div>
                <div class="nav-button"><a href="search"><i class="fa-solid fa-magnifying-glass"></i> &nbsp<div>Search</div></a></div>
                <div class="nav-button"><a href="settings"><i class="fa-solid fa-gear"></i> &nbsp<div>Settings</div></a></div>
                <?php
                if ($userRepository->getRole($_SESSION['user_email']) === "admin") {
                ?>
                    <div class="nav-button"><a href="add_content" class="current-section"><i class="fa-solid fa-plus"></i> &nbsp<div>Upload</div></a></div>
                <?php
                }
                ?>
            </div>
        </nav>
        <div id="upload-container">
            <h1>Upload</h1>
            <form action="add_content" method="POST" ENCTYPE="multipart/form-data">
                <div class="messages">
                <?php
                    if (isset($messages)) {
                    foreach($messages as $message) {
                        echo $message;
                    }
                    }
                ?>
                </div>
                <input name="title" type="text" placeholder="Name"><br/>
                <textarea name="event-description" rows="3" placeholder="Description"></textarea><br/>
                <?php
                    require_once 'src/repository/OptionRepository.php';
                    require_once 'src/models/Option.php';
                    $optionRepository = new OptionRepository();
                    $options = $optionRepository->getOptions("locations");
                ?>

                <select name="location">
                    <?php foreach ($options as $option): ?>
                        <option value="<?php echo $option->getId(); ?>"><?php echo $option->getName(); ?></option>
                    <?php endforeach; ?>
                </select><br/>

                <?php
                    $optionRepository = new OptionRepository();
                    $options = $optionRepository->getOptions("categories");
                ?>
                <select name="category">
                    <?php foreach ($options as $option): ?>
                        <option value="<?php echo $option->getId(); ?>"><?php echo $option->getName(); ?></option>
                    <?php endforeach; ?>
                </select><br/>

                <input type="number" name="min-price" placeholder="Min. price"><br/>
                <input type="number" name="max-price" placeholder="Max. price"><br/>
                <input type="date" name="date"><br/>
                <input type="file" name="file"><br/>
                <label><b>Promoted </b><input type="checkbox" name="is-promoted" value="true"><br/></label>
                <button type="submit">Upload</button>
            </form>
        </div>
    </body>
</html>