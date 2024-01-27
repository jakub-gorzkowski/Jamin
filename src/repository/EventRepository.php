<?php

require_once 'Repository.php';

class EventRepository extends Repository
{
    public function getEvent(int $id): ?Event
    {
        $statement = $this -> database -> connect() -> prepare(
            'SELECT * FROM public.events WHERE id = :id'
        );
        $statement -> bindParam(':id', $id, PDO::PARAM_INT);
        $statement -> execute();

        $event = $statement -> fetch(PDO::FETCH_ASSOC);

        if ($event == false) {
            return null;
        }

        return new Event(
            $event['name'],
            $event['description'],
            $event['image'],
            $event['date'],
            $event['location'],
            $event['category'],
            $event['min_price'],
            $event['max_price'],
            $event['is_promoted']
        );
    }

    public function addEvent(Event $event): void
    {
        $statement = $this -> database -> connect() -> prepare(
            'INSERT INTO events (
                name, 
                description, 
                image, 
                date, 
                location_id, 
                category_id, 
                min_price, 
                max_price, 
                is_promoted
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);'
        );

        $statement -> execute([
            $event -> getName(),
            $event -> getDescription(),
            $event -> getImage(),
            $event -> getDate(),
            $event -> getLocationId(),
            $event -> getCategoryId(),
            $event -> getMinPrice(),
            $event -> getMaxPrice(),
            $event -> IsPromoted() ? 1 : 0
        ]);
    }
}