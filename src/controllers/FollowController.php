<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Followed.php';
require_once __DIR__.'/../repository/FollowedRepository.php';

class FollowController extends AppController
{
    private $followedRepository;
    public function __construct()
    {
        parent::__construct();
        $this -> followedRepository = new FollowedRepository();
    }

    public function follow()
    {
        if ($this->isPost()) {

            $followed = new Followed(
                $_POST['user-id'],
                $_POST['event-id']
            );

            $this->followedRepository->followEvent($followed);
            $this->render('followed', ['messages' => '']);
        }
    }

    public function unfollow()
    {
        if ($this->isPost()) {

            $followed = new Followed(
                $_POST['user-id'],
                $_POST['event-id']
            );

            $this->followedRepository->unfollowEvent($followed);
            $this->render('followed', ['messages' => '']);
        }
    }
}