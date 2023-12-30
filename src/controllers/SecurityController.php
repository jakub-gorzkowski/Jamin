<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {

    public function login() {
        $user = new User('x', 'd');

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->getEmail() !== $email || $user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Invalid username or password']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");

    }
}

?>