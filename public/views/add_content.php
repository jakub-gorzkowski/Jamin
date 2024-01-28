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
        <title>Upload</title>
    </head>
    <body>
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
    </body>
</html>