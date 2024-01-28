<?php


class Followed
{
    private $userId;
    private $objectId;

    public function __construct(int $userId, int $objectId)
    {
        $this->userId = $userId;
        $this->objectId = $objectId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getObjectId(): int
    {
        return $this->objectId;
    }

}