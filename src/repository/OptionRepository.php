<?php

require_once 'Repository.php';

class OptionRepository extends Repository
{
    public function getOptions(string $type): array
    {
        $result = [];

        $statement = $this -> database -> connect() -> prepare(
            'SELECT * FROM public.'.$type.';'
        );
        $statement -> execute();

        $locations = $statement -> fetchAll(PDO::FETCH_ASSOC);

        foreach ($locations as $location) {
            $result[] = new Option($location['id'], $location['name']);
        }

        return $result;
    }
}