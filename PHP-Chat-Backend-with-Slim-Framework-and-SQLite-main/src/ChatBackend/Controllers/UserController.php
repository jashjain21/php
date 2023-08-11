<?php

namespace jashjain\ChatBackend\Controllers;

use jashjain\ChatBackend\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class UserController
{
    public function createUser(Request $request, Response $response, $args)
    {
        echo "Camr here";
        // Get request body data
        $data = $request->getParsedBody();

        // Validate input data
        $username = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';

        if (empty($username) || empty($password)) {
            return $response->withStatus(400)->withJson(['error' => 'Username and password are required']);
        }

        // Check if username already exists
        $existingUser = User::where('username', $username)->first();
        if ($existingUser) {
            return $response->withStatus(409)->withJson(['error' => 'Username already exists']);
        }

        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Create the user
        $user = new User();
        $user->username = $username;
        $user->password = $hashedPassword;
        $user->save();

        return $response->withJson(['message' => 'User created successfully']);
    }

    public function getUsers(Request $request, Response $response, $args)
    {
        $users = User::all(['id', 'username']);

        return $response->withJson(['users' => $users]);
    }
}