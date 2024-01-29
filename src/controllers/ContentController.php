<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Event.php';
require_once __DIR__.'/../repository/EventRepository.php';

class ContentController extends AppController
{
    const MAX_IMAGE_SIZE = 8 * 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $eventRepository;

    public function __construct()
    {
        parent::__construct();
        $this -> eventRepository = new EventRepository();
    }

    public function add_content()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $event = new Event(
                0,
                $_POST['title'],
                $_POST['event-description'],
                $_FILES['file']['name'],
                $_POST['date'],
                $_POST['location'],
                $_POST['category'],
                $_POST['min-price'],
                $_POST['max-price'],
                isset($_POST['is-promoted'])
            );
            $this->eventRepository->addEvent($event);

            $this->render('home', ['messages' => $this->messages, 'event' => $event]);
        }
        $this->render('add_content', ['messages' => $this->messages]);
    }

    public function searchEvent()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->eventRepository->getEventByName($decoded['search']));
        }
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