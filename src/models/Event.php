<?php

class Event
{
    private $name;
    private $description;
    private $image;
    private $date;
    private $location;
    private $category;
    private $minPrice;
    private $maxPrice;
    private $isPromoted;

    public function __construct($name, $description, $image, $date, $location, $category, $minPrice, $maxPrice, $isPromoted)
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->date = $date;
        $this->location = $location;
        $this->category = $category;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
        $this->isPromoted = $isPromoted;
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

    public function getName(): string
    {
        return $this->name;
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

    public function IsPromoted(): bool
    {
        return $this->isPromoted;
    }
}
?>