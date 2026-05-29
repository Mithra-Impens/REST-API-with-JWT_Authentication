<?php

class Patient
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function getAll($userId)
    {
        $sql = "SELECT * FROM patients WHERE user_id = :user_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data, $userId)
    {
        $sql = "INSERT INTO patients(user_id, name, age, gender, phone, address)
                VALUES(:user_id, :name, :age, :gender, :phone, :address)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':user_id'  => $userId,
            ':name'    => $data['name'],
            ':age'     => $data['age'],
            ':gender'  => $data['gender'],
            ':phone'   => $data['phone'],
            ':address' => $data['address']
        ]);
    }

    public function findById($id, $userId)
    {
        $sql = "SELECT * FROM patients WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id, ':user_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data, $userId)
    {
        $sql = "UPDATE patients
                SET name = :name, age = :age, gender = :gender,
                    phone = :phone, address = :address
                WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name'    => $data['name'],
            ':age'     => $data['age'],
            ':gender'  => $data['gender'],
            ':phone'   => $data['phone'],
            ':address' => $data['address'],
            ':id'      => $id,
            ':user_id' => $userId
        ]);
    }

    public function delete($id, $userId)
    {
        $sql = "DELETE FROM patients WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id, ':user_id' => $userId]);
    }
}