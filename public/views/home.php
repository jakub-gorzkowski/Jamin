<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
    </head>
    <body>
        <h1>home page</h1>
        <img src="public/uploads/<?= $event->getImage() ?>">
        <h2><?= $event->getTitle() ?></h2>
        <p><?= $event->getDescription() ?></p>
    </body>
</html>