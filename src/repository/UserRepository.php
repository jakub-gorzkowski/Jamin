<?php

require_once "Repository.php";
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $statement = $this -> database -> connect() -> prepare(
            'SELECT * FROM public.users WHERE email = :email'
        );
        $statement -> bindParam(':email', $email, PDO::PARAM_STR);
        $statement -> execute();

        $user = $statement -> fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User($user['email'], $user['password']);
    }

    public function getUserId(string $email): int
    {
        $statement = $this -> database -> connect() -> prepare(
            'SELECT id FROM public.users WHERE email = :email'
        );
        $statement -> bindParam(':email', $email, PDO::PARAM_STR);
        $statement -> execute();

        $user = $statement -> fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            throw new PDOException("No such user");
        }

        return $user['id'];
    }

    public function addUser(User $user): void
    {
        $statement = $this -> database -> connect() -> prepare(
            'INSERT INTO users (email, password) VALUES (?, ?);'
        );

        $statement -> execute([
            $user -> getEmail(),
            $user -> getPassword()
        ]);
    }
}