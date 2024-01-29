<?php

require_once 'Repository.php';

class FollowedRepository extends Repository
{
    public function followEvent(Followed $followed): void
    {
        $statement = $this -> database -> connect() -> prepare(
            'INSERT INTO followed (user_id, event_id) VALUES (?, ?);'
        );

        try {
        $statement -> execute([
            $followed -> getUserId(),
            $followed -> getObjectId()
        ]);
        }  catch (PDOException $e) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/followed");
            exit();
        }
    }

    public function unfollowEvent(Followed $followed): void
    {
        $statement = $this -> database -> connect() -> prepare(
            'DELETE FROM followed WHERE user_id = ? AND event_id = ?;'
        );
        try {
        $statement -> execute([
            $followed -> getUserId(),
            $followed -> getObjectId()
        ]);
        }  catch (PDOException $e) {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/followed");
        exit();
    }
    }

    public function addLocation(Followed $preference, string $type): void
    {
        $query = 'INSERT INTO '.$type.' (user_id, location_id) VALUES (?, ?)';
        $statement = $this -> database -> connect() -> prepare($query);

        try {
            $statement->execute([
                $preference->getUserId(),
                $preference->getObjectId()
            ]);
        } catch (PDOException $e) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/settings");
            exit();
        }
    }

    public function removeLocation(Followed $preference, string $type): void
    {
        $query = 'DELETE FROM '.$type.' WHERE user_id = ? AND location_id = ?';
        $statement = $this -> database -> connect() -> prepare($query);

        try {
            $statement->execute([
                $preference->getUserId(),
                $preference->getObjectId()
            ]);
        } catch (PDOException $e) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/settings");
            exit();
        }
    }

    public function addCategory(Followed $preference, string $type): void
    {
        $query = 'INSERT INTO '.$type.' (user_id, category_id) VALUES (?, ?)';
        $statement = $this -> database -> connect() -> prepare($query);

        try {
            $statement->execute([
                $preference->getUserId(),
                $preference->getObjectId()
            ]);
        } catch (PDOException $e) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/settings");
            exit();
        }
    }

    public function removeCategory(Followed $preference, string $type): void
    {
        $query = 'DELETE FROM '.$type.' WHERE user_id = ? AND category_id = ?';
        $statement = $this -> database -> connect() -> prepare($query);

        try {
            $statement->execute([
                $preference->getUserId(),
                $preference->getObjectId()
            ]);
        } catch (PDOException $e) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/settings");
            exit();
        }
    }

}