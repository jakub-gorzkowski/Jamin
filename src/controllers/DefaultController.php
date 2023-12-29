<?php 

require_once 'AppController.php';

class DefaultController extends AppController {

    public function register() {
        $this -> render('register');
    }

    public function login() {
        $this -> render('login');
    }

    public function home() {
        $this -> render('home');
    }

    public function followed() {
        $this -> render('followed');
    }

    public function search() {
        $this -> render('search');
    }

    public function settings() {
        $this -> render('settings');
    }

    public function notfound() {
        $this -> render('notfound');
    }
}

?>