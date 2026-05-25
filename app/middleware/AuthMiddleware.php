<?php

class AuthMiddleware
{
    public static function handle()
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            Response::json(false, "Authorization header missing", [], 401);
        }

        $authHeader = $headers['Authorization'];

        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            Response::json(false, "Invalid token format", [], 401);
        }

        $token = $matches[1];

        $decoded = JWT::validate($token);

        if (!$decoded) {
            Response::json(false, "Invalid or expired token", [], 401);
        }

        $_REQUEST['user'] = $decoded;
    }
}