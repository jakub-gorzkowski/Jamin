<?php

require_once 'Repository.php';

class EventRepository extends Repository
{
    public function getEvents(int $userId = null, bool $isPromoted = null): array
    {
        $result = [];
        $query = 'SELECT * FROM get_events';

        if($userId != null && $isPromoted != null)
        {
            $query .= ' WHERE is_promoted = :is_promoted';
            if (!$isPromoted)
                $query .= ' AND user_id = :user_id';
        }
        else
        {
            $query .= ' WHERE is_promoted = false';
        }

        $statement = $this->database->connect()->prepare($query);

        if($userId != null && $isPromoted != null)
        {
            $statement->bindParam(':is_promoted', $isPromoted, PDO::PARAM_BOOL);
            if (!$isPromoted)
                $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        }

        $statement->execute();

        $events = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($events as $event) {
            $result[] = new Event(
                $event['id'],
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

        return $result;
    }

    public function getFollowedEvents(int $userId, string $sign): array
    {
        $result = [];
        $query = 'SELECT * FROM get_followed_events';
        $query .= ' WHERE user_id = :user_id AND event_date '.$sign.' CURRENT_DATE';
        $statement = $this -> database -> connect() -> prepare($query);
        $statement -> bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement -> execute();

        $events = $statement -> fetchAll(PDO::FETCH_ASSOC);

        foreach ($events as $event) {
            $result[] = new Event(
                $event['id'],
                $event['name'],
                $event['description'],
                $event['image'],
                $event['event_date'],
                $event['location'],
                $event['category'],
                $event['min_price'],
                $event['max_price'],
                $event['is_promoted']
            );
        }

        return $result;
    }

    public function getEventByName(string $searchString)
    {
        $searchString = '%'.strtolower($searchString).'%';

        $query = 'SELECT * FROM search_event';
        $query .= ' WHERE LOWER(event_name) LIKE :search OR LOWER(event_description) LIKE :search';

        $statement = $this->database->connect()->prepare($query);
        $statement -> bindParam(':search', $searchString, PDO::PARAM_STR);
        $statement -> execute();

        return $statement -> fetchAll(PDO::FETCH_ASSOC);
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
            $event -> getLocation(),
            $event -> getCategory(),
            $event -> getMinPrice(),
            $event -> getMaxPrice(),
            $event -> IsPromoted() ? 1 : 0
        ]);
    }
}