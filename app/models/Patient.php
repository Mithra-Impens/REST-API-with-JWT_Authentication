<?php

class Patient
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM patients ORDER BY id DESC";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO patients(name, age, gender, phone, address)
                VALUES(:name, :age, :gender, :phone, :address)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':name' => $data['name'],
            ':age' => $data['age'],
            ':gender' => $data['gender'],
            ':phone' => $data['phone'] ?? null,
            ':address' => $data['address'] ?? null
        ]);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM patients WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE patients
                SET
                    name = :name,
                    age = :age,
                    gender = :gender,
                    phone = :phone,
                    address = :address
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':name' => $data['name'],
            ':age' => $data['age'],
            ':gender' => $data['gender'],
            ':phone' => $data['phone'] ?? null,
            ':address' => $data['address'] ?? null,
            ':id' => $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM patients WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}