<?php 
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('register', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::get('home', 'DefaultController');
Routing::get('followed', 'DefaultController');
Routing::get('search', 'DefaultController');
Routing::get('settings', 'DefaultController');
Routing::get('notfound', 'DefaultController');
Routing::post('add_content', 'ContentController');
Routing::run($path);
?>