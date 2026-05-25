<?php

class AuthController
{
    public function register()
    {
        $data = $_REQUEST['body'];

        if (
            empty($data['name']) ||
            empty($data['email']) ||
            empty($data['password'])
        ) {
            Response::json(false, "All fields are required", [], 400);
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            Response::json(false, "Invalid email format", [], 400);
        }

        if (strlen($data['password']) < 6) {
            Response::json(false, "Password must be at least 6 characters", [], 400);
        }

        $userModel = new User();

        $existingUser = $userModel->findByEmail($data['email']);

        if ($existingUser) {
            Response::json(false, "Email already exists", [], 409);
        }

        $hashedPassword = password_hash(
            $data['password'],
            PASSWORD_DEFAULT
        );

        $userModel->create(
            $data['name'],
            $data['email'],
            $hashedPassword
        );

        Response::json(true, "User registered successfully");
    }

    public function login()
    {
        $data = $_REQUEST['body'];

        if (
            empty($data['email']) ||
            empty($data['password'])
        ) {
            Response::json(false, "Email and password required", [], 400);
        }

        $userModel = new User();

        $user = $userModel->findByEmail($data['email']);

        if (!$user) {
            Response::json(false, "Invalid credentials", [], 401);
        }

        if (
            !password_verify(
                $data['password'],
                $user['password']
            )
        ) {
            Response::json(false, "Invalid credentials", [], 401);
        }

        $token = JWT::generate([
            'user_id' => $user['id'],
            'email' => $user['email']
        ]);

        Response::json(true, "Login successful", [
            "token" => $token,
            "expires_in" => $_ENV['JWT_EXPIRY']
        ]);
    }
}