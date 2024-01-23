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

        return new Event($event['title'], $event['description'], $event['image']);
    }

    public function addEvent(Event $event): void
    {
        $statement = $this -> database -> connect() -> prepare(
            'INSERT INTO events (name, description) VALUES (?, ?);'
        );

        $statement -> execute([
            $event -> getTitle(),
            $event -> getDescription()
            //$event -> getDate()
        ]);
    }
}