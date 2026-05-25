<?php

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $email, $password)
    {
        $sql = "INSERT INTO users(name, email, password)
                VALUES(:name, :email, :password)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password
        ]);
    }
}