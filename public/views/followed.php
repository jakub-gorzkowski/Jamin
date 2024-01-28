<?php
require_once 'src/controllers/SessionController.php';
require_once 'src/repository/UserRepository.php';
$userRepository = new UserRepository();
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
        <link rel="stylesheet" href="public/style/followed.css">
        <script src="https://kit.fontawesome.com/2069fca16b.js" crossorigin="anonymous"></script>
        <title>Followed</title>
    </head>
    <body>
        <nav>
            <div id="logo-container">
                <img src="public/images/Jamin.png" alt="Jamin">
            </div>
            <div id="nav-button-container">
                <div class="nav-button"><a href="home"><i class="fa-solid fa-house"></i> Home</a></div>
                <div class="nav-button"><a href="followed" class="current-section"><i class="fa-solid fa-eye"></i> Followed</a></div>
                <div class="nav-button"><a href="search"><i class="fa-solid fa-magnifying-glass"></i> Search</a></div>
                <div class="nav-button"><a href="settings"><i class="fa-solid fa-gear"></i> Settings</a></div>
                <?php
                if ($userRepository->getRole($_SESSION['user_email']) === "admin") {
                    ?>
                    <div class="nav-button"><a href="add_content"><i class="fa-solid fa-plus"></i> Upload</a></div>
                    <?php
                }
                ?>
            </div>
        </nav>

        <div class="section-container">
            <div class="section-header-container">
                <h2>Upcoming</h2>
                <button class="show-all">Show all</button>
            </div>
            <?php
            require_once 'src/repository/EventRepository.php';
            require_once 'src/repository/UserRepository.php';
            require_once 'src/models/Event.php';
            $eventRepository = new EventRepository();
            $userRepository = new UserRepository();
            $events = $eventRepository->getFollowedEvents($userRepository->getUserId($_SESSION['user_email']), ">=");
            ?>
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
                            <div class="price-range"><i class="fa-solid fa-money-bill-1-wave"></i> <?= intval($event->getMinPrice());?>-<?= intval($event->getMaxPrice());?></div>

                            <form id="followForm" action="unfollow" method="POST" ENCTYPE="multipart/form-data">
                            <input type="hidden" name="event-id" value="<?= $event->getId(); ?>">
                            <input type="hidden" name="user-id" value="<?= $userRepository->getUserId($_SESSION['user_email']); ?>">
                            <button class="follow-button" type="submit" onclick="changeButtonText(this)">Unfollow</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>

        <script>
            function changeButtonText(button) {
                if (button.innerText === 'Follow') {
                    button.innerText = 'Unfollow';
                    document.getElementById('followForm').setAttribute('action', 'follow');
                } else {
                    button.innerText = 'Follow';
                    document.getElementById('followForm').setAttribute('action', 'unfollow');
                }
            }
        </script>

        <div class="section-container">
            <div class="section-header-container">
                <h2>Past events</h2>
                <button class="show-all">Show all</button>
            </div>
            <?php
            require_once 'src/repository/EventRepository.php';
            require_once 'src/repository/UserRepository.php';
            require_once 'src/models/Event.php';
            $eventRepository = new EventRepository();
            $userRepository = new UserRepository();
            $events = $eventRepository->getFollowedEvents($userRepository->getUserId($_SESSION['user_email']), "<");
            ?>
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
                            <div class="location"><i class="fa-solid fa-location-dot"></i>&nbsp;<?= $event->getLocation();?></div>
                            <div class="category"><i class="fa-solid fa-table-cells"></i>&nbsp;<?= $event->getCategory();?></div>
                            <div class="price-range"><i class="fa-solid fa-money-bill-1-wave"></i>&nbsp;<?= $event->getMinPrice();?>-<?= $event->getMaxPrice();?></div>
                            <button class="follow-button" type="button">Follow</button>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </body>
</html>