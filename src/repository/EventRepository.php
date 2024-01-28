<?php

require_once 'Repository.php';

class EventRepository extends Repository
{
    public function getEvents(int $userId = null, bool $isPromoted = null): array
    {
        $result = [];
        $query = 'SELECT 
                    e.id,
                    e.name, 
                    e.description,
                    e.date, 
                    e.image, 
                    e.min_price, 
                    e.max_price, 
                    l.name AS location, 
                    c.name AS category, e.is_promoted
                FROM Events e
                    JOIN Locations l ON e.location_id = l.id
                    JOIN Categories c ON e.category_id = c.id
                    JOIN observed_categories oc ON c.id = oc.category_id
                    JOIN observed_locations ol ON l.id = ol.location_id
                    JOIN Users u ON oc.user_id = u.id AND ol.user_id = u.id';

        if($userId != null && $isPromoted != null)
        {
            $query .= ' WHERE e.is_promoted = :is_promoted';
            if (!$isPromoted)
                $query .= ' AND u.id = :user_id';
        }
        else
        {
            $query .= ' WHERE e.is_promoted = false';
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
        $statement = $this -> database -> connect() -> prepare(
            'SELECT
                e.id,
                e.name,
                e.description,
                e.image,
                e.date,
                e.min_price,
                e.max_price,
                e.is_promoted,
                l.name AS location,
                c.name AS category
            FROM
                Events e
                JOIN
                Followed f ON e.id = f.event_id
                JOIN
                Users u ON f.user_id = u.id
                LEFT JOIN
                Locations l ON e.location_id = l.id
                LEFT JOIN
                Categories c ON e.category_id = c.id
            WHERE
                u.id = :user_id
                AND e.date'. $sign .' CURRENT_DATE
            ORDER BY
                e.date DESC;'
        );
        $statement -> bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement -> execute();

        $events = $statement -> fetchAll(PDO::FETCH_ASSOC);

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

    public function getEventByName(string $searchString)
    {
        $searchString = '%'.strtolower($searchString).'%';

        $statement = $this->database->connect()->prepare(
            'SELECT events.*, locations.name AS location_name, categories.name AS category_name
         FROM events
         INNER JOIN locations ON events.location_id = locations.id
         INNER JOIN categories ON events.category_id = categories.id
         WHERE LOWER(events.name) LIKE :search OR LOWER(events.description) LIKE :search;'
        );
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