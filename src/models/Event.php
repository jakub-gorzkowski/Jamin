<?php

class Event
{
    private $title;
    private $description;
    private $image;
    private $date;

    public function __construct($title, $description, $image)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        //$this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}
?>