<?php

class Event
{
    private $title;
    private $description;
    private $image;
    private $date;
    private $location;
    private $category;
    private $minPrice;
    private $maxPrice;

    public function __construct($title, $description, $image, $date, $location, $category, $minPrice, $maxPrice)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->date = $date;
        $this->location = $location;
        $this->category = $category;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
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

    public function getLocation()
    {
        return $this->location;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getMinPrice()
    {
        return $this->minPrice;
    }

    public function getMaxPrice()
    {
        return $this->maxPrice;
    }
}
?>