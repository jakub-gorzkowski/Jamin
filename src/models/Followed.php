<?php


class Followed
{
    private $userId;
    private $eventId;

    public function __construct(int $userId, int $eventId)
    {
        $this->userId = $userId;
        $this->eventId = $eventId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getEventId(): int
    {
        return $this->eventId;
    }

}