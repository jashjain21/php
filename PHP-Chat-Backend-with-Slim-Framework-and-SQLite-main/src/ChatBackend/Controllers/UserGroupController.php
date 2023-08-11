<?php

namespace jashjain\ChatBackend\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use jashjain\ChatBackend\Models\UserGroup;
use jashjain\ChatBackend\Models\Group;
use jashjain\ChatBackend\Models\User;
use jashjain\ChatBackend\Models\Message;

class UserGroupController
{
    public function joinGroup(Request $request, Response $response, $args)
    {
        // Get request body data
        $data = $request->getParsedBody();

        // Validate input data
        $userId = $data['user_id'] ?? 0; // Ensure user_id is provided and not empty
        $groupId = $args['group_id'] ?? 0; // Ensure group_id is provided and not empty

        if (empty($userId) || empty($groupId)) {
            return $response->withStatus(400)->withJson(['error' => 'User ID and group ID are required']);
        }

        // Check if user and group exist
        $user = User::find($userId);
        $group = Group::find($groupId);

        if (!$user || !$group) {
            return $response->withStatus(404)->withJson(['error' => 'User or group not found']);
        }

        // Check if the user is already a member of the group
        $existingUserGroup = UserGroup::where(['user_id' => $userId, 'group_id' => $groupId])->first();
        if ($existingUserGroup) {
            return $response->withStatus(409)->withJson(['error' => 'User is already a member of the group']);
        }

        // Create the user-group relationship
        $userGroup = new UserGroup();
        $userGroup->user_id = $userId;
        $userGroup->group_id = $groupId;
        $userGroup->save();

        return $response->withJson(['message' => 'User joined the group successfully']);
    }
}