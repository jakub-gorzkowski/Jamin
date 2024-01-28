<?php

require_once 'AppController.php';
require_once 'SessionController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login() {
        $userRepository = new UserRepository();

        if (!$this->isPost())
        {
            return $this->render('login');
        }

        $email = $_POST['email'];

        $user = $userRepository -> getUser($email);

        if (!$user)
        {
            return $this->render('login', ['messages' => ['User does not exists']]);
        }

        if ($user->getEmail() !== $email || !password_verify($_POST['password'], $user->getPassword()))
        {
            return $this->render('login', ['messages' => ['Invalid email or password']]);
        }

        $session = new SessionController();
        $session->startSession($user->getEmail());

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function register()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmed-password'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Passwords are different']]);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = new User($email, $hashedPassword);

        $userExists = $userRepository->getUser($email);

        if ($userExists) {
            return $this->render('register', ['messages' => ['User with given email already exists']]);
        }

        $userRepository->addUser($user);
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }

    public function change_password()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('settings');
        }

        $user = $userRepository->getUser($_SESSION['user_email']);

        $oldPassword = $_POST['old-password'];
        $newPassword = $_POST['new-password'];
        $newPasswordConfirmed = $_POST['new-password-confirmed'];

        if (!password_verify($oldPassword, $user->getPassword())) {
            return $this->render('settings', ['messages' => ['Incorrect password']]);
        }

        if ($newPassword !== $newPasswordConfirmed) {
            return $this->render('settings', ['messages' => ['Passwords don\'t match']]);
        }

        $userId = $userRepository->getUserId($_SESSION['user_email']);
        $userRepository->changePassword($userId, password_hash($newPassword, PASSWORD_DEFAULT));

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/settings");
    }
}

?>