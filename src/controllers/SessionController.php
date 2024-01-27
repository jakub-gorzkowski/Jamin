<?php

require_once 'AppController.php';

session_start();

class SessionController extends AppController
{
    public function startSession(string $user_email)
    {
        if (!isset($_SESSION['user_email']))
        {
            $_SESSION['user_email'] = $user_email;
        }
    }

    public function checkSession()
    {
        return isset($_SESSION['user_email']);
    }

    public function logout()
    {
        if (isset($_SESSION))
        {
            session_unset();
            session_destroy();
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
        exit();
    }

}