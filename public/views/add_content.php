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
            <?php
                if (isset($messages)) {
                   foreach($messages as $message) {
                       echo $message;
                   }
                }
            ?>
            <input name="title" type="text" placeholder="Image title"><br/>
            <textarea name="event-description" rows="3" placeholder="Event description"></textarea><br/>
            <input type="file" name="file"><br/>
            <button type="submit">Upload</button>
        </form>
    </body>
</html>