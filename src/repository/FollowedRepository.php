<?php

require_once 'Repository.php';

class FollowedRepository extends Repository
{
    public function followEvent(Followed $followed): void
    {
        $statement = $this -> database -> connect() -> prepare(
            'INSERT INTO followed (user_id, event_id) VALUES (?, ?);'
        );

        $statement -> execute([
            $followed -> getUserId(),
            $followed -> getEventId()
        ]);
    }

    public function unfollowEvent(Followed $followed): void
    {
        $statement = $this -> database -> connect() -> prepare(
            'DELETE FROM followed WHERE user_id = ? AND event_id = ?;'
        );

        $statement -> execute([
            $followed -> getUserId(),
            $followed -> getEventId()
        ]);
    }

}