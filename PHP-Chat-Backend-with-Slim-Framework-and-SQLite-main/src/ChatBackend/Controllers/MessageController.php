<?php

namespace jashjain\ChatBackend\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use jashjain\ChatBackend\Models\Message;
use jashjain\ChatBackend\Models\User;
use jashjain\ChatBackend\Models\Group;
use jashjain\ChatBackend\Models\UserGroup;


class MessageController
{
    public function sendMessage(Request $request, Response $response, $args)
    {
    // Get request body data
    $data = $request->getParsedBody();

    // Validate input data
    $userId = $data['user_id'] ?? 0; // Ensure user_id is provided and not empty
    $groupId = $args['group_id'] ?? 0; // Ensure group_id is provided and not empty
    $content = $data['content'] ?? '';

    if (empty($userId) || empty($groupId) || empty($content)) {
        return $response->withStatus(400)->withJson(['error' => 'User ID, group ID, and content are required']);
    }

    // Check if user and group exist
    $user = User::find($userId);
    $group = Group::find($groupId);

    if (!$user || !$group) {
        return $response->withStatus(404)->withJson(['error' => 'User or group not found']);
    }

    // Check if the user is a member of the group using UserGroup model
    $userGroupMapping = UserGroup::where(['user_id' => $userId, 'group_id' => $groupId])->first();
    if (!$userGroupMapping) {
        return $response->withStatus(403)->withJson(['error' => 'User is not a member of the group']);
    }

    // Create the message
    $message = new Message();
    $message->user_id = $userId;
    $message->group_id = $groupId;
    $message->content = $content;
    $message->save();

    return $response->withJson(['message' => 'Message sent successfully']);
    }

    public function getMessages(Request $request, Response $response, $args)
    {
        $groupId = $args['group_id'] ?? 0; // Ensure group_id is provided and not empty

        if (empty($groupId)) {
            return $response->withStatus(400)->withJson(['error' => 'Group ID is required']);
        }

        // Check if group exists
        $group = Group::find($groupId);

        if (!$group) {
            return $response->withStatus(404)->withJson(['error' => 'Group not found']);
        }

        // Fetch messages for the group
        $messages = Message::where('group_id', $groupId)->get();

        return $response->withJson(['messages' => $messages]);
    }
    
}