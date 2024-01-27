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

        $options = $statement -> fetchAll(PDO::FETCH_ASSOC);

        foreach ($options as $option) {
            $result[] = new Option($option['id'], $option['name']);
        }

        return $result;
    }
}