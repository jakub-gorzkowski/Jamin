<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Event.php';

class ContentController extends AppController
{
    const MAX_IMAGE_SIZE = 8 * 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    public function add_content()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $event = new Event($_POST['title'], $_POST['event-description'], $_FILES['file']['name']);

            $this->render('home', ['messages' => $this->messages, 'event' => $event]);
        }
        $this->render('add_content', ['messages' => $this->messages]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_IMAGE_SIZE) {
            $this->messages[] = 'Image size is too large';
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'Unsupported file type';
            return false;
        }

        return true;
    }
}
?>