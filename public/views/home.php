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
        <link rel="stylesheet" href="public/style/home.css">
        <script src="https://kit.fontawesome.com/2069fca16b.js" crossorigin="anonymous"></script>
        <title>Home</title>
    </head>
    <body>
        <nav>
            <div id="logo-container">
                <img src="public/images/Jamin.png" alt="Jamin">
            </div>
            <div id="nav-button-container">
                <div class="nav-button"><a href="home" class="current-section"><i class="fa-solid fa-house"></i> Home</a></div>
                <div class="nav-button"><a href="followed"><i class="fa-solid fa-eye"></i> Followed</a></div>
                <div class="nav-button"><a href="search"><i class="fa-solid fa-magnifying-glass"></i> Search</a></div>
                <div class="nav-button"><a href="settings"><i class="fa-solid fa-gear"></i> Settings</a></div>
            </div>
        </nav>

        <div class="promoted-container">
            <div class="section-header-container">
                <h2>Promoted events</h2>
            </div>

            <?php
            require_once 'src/repository/EventRepository.php';
            require_once 'src/repository/UserRepository.php';
            require_once 'src/models/Event.php';
            $eventRepository = new EventRepository();
            $userRepository = new UserRepository();
            $events = $eventRepository->getEvents($userRepository->getUserId($_SESSION['user_email']), true);
            ?>
            <?php foreach($events as $event): ?>
            <div class="promoted-event">
                <img src="public/uploads/<?= $event->getImage();?>" alt="promoted-event-image">
                <div class="promoted-event-information">
                    <h3><?= $event->getName();?></h3>
                    <article><?= $event->getDescription();?></article>
                </div>
            </div>
            <?php endforeach;?>
        </div>

        <div class="section-container"> 
            <div class="section-header-container">
                <h2>Recommended for you</h2>
            </div>
            <?php $events = $eventRepository->getEvents($userRepository->getUserId($_SESSION['user_email']), false); ?>
            <?php foreach($events as $event): ?>
            <div class="recommended-event">
                <div class="image-container">
                    <img src="public/uploads/<?= $event->getImage();?>" alt="event-image">
                </div>
                <div class="information-container">
                    <div class="event-name">
                        <h3><?= $event->getName();?></h3>
                    </div>
                    <div class="description">
                        <article><?= $event->getDescription();?></article>
                    </div>
                    <div class="details-container">
                        <div class="location"><i class="fa-solid fa-location-dot"></i> <?= $event->getLocation();?></div>
                        <div class="category"><i class="fa-solid fa-table-cells"></i> <?= $event->getCategory();?></div>
                        <div class="price-range"><i class="fa-solid fa-money-bill-1-wave"></i> <?= $event->getMinPrice();?>-<?= $event->getMaxPrice();?></div>
                        <button class="follow-button" type="button">Follow</button>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </body>
</html>
