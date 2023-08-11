<?php

namespace jashjain\ChatBackend\Controllers;

use jashjain\ChatBackend\Models\Group;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class GroupController
{
    public function createGroup(Request $request, Response $response, $args)
    {
        // Get request body data
        $data = $request->getParsedBody();

        // Validate input data
        $groupName = trim($data['name'] ?? '');

        if (empty($groupName)) {
            return $response->withStatus(400)->withJson(['error' => 'Group name is required']);
        }

        // Check if the group name already exists
        $existingGroup = Group::where('name', $groupName)->first();
        if ($existingGroup) {
            return $response->withStatus(409)->withJson(['error' => 'Group already exists']);
        }

        // Create the group
        $group = new Group();
        $group->name = $groupName;
        $group->save();

        return $response->withJson(['message' => 'Group created successfully']);
    }

    public function getGroups(Request $request, Response $response, $args)
    {
        $groups = Group::all(['id', 'name']);

        return $response->withJson(['groups' => $groups]);
    }
}