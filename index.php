<?php
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('notfound', 'DefaultController');
Routing::post('register', 'SecurityController');
Routing::post('login', 'SecurityController');
Routing::post('change_password', "SecurityController");

Routing::get('home', 'DefaultController');
Routing::get('followed', 'DefaultController');
Routing::post('search', 'DefaultController');
Routing::get('settings', 'DefaultController');
Routing::post('logout', 'SessionController');
Routing::post('follow', 'FollowController');
Routing::post('unfollow', 'FollowController');
Routing::post('add_location', 'FollowController');
Routing::post('remove_location', 'FollowController');
Routing::post('add_category', 'FollowController');
Routing::post('remove_category', 'FollowController');
Routing::post('searchEvent', 'ContentController');

Routing::post('add_content', 'ContentController');

Routing::get('event', 'DefaultController');
Routing::get('account', 'DefaultController');
Routing::get('preferences', 'DefaultController');

Routing::run($path);
?>