<?php
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('notfound', 'DefaultController');
Routing::post('register', 'SecurityController');
Routing::post('login', 'SecurityController');

Routing::get('home', 'DefaultController');
Routing::get('followed', 'DefaultController');
Routing::get('search', 'DefaultController');
Routing::get('settings', 'DefaultController');

Routing::post('add_content', 'ContentController');

Routing::get('event', 'DefaultController');
Routing::get('account', 'DefaultController');
Routing::get('preferences', 'DefaultController');

Routing::run($path);
?>