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

    public function add_content() {
        $this -> render('add_content');
    }

    public function event()
    {
        $this -> render('event');
    }

    public function account()
    {
        $this -> render('account');
    }

    public function preferences()
    {
        $this -> render('preferences');
    }
}

?>