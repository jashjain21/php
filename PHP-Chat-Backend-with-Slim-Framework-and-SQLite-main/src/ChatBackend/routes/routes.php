<?php
namespace jashjain\ChatBackend;
use Slim\Routing\RouteCollectorProxy;

// use jashjain\ChatBackend\Controllers\GroupController as GroupControllerAlias;
// use jashjain\ChatBackend\Controllers\MessageController as MessageControllerAlias;
// use jashjain\ChatBackend\Controllers\UserController as UserControllerAlias;
// use jashjain\ChatBackend\Controllers\UserGroupController as UserGroupControllerAlias;

return function ($app) {
$app->group('/api', function (RouteCollectorProxy $group) {
    // Group endpoints
    // $group->post('/groups', GroupControllerAlias::class . ':createGroup');
    // $group->get('/groups', GroupControllerAlias::class . ':getGroups');
    
    // // Message endpoints within a group
    // $group->post('/groups/{group_id}/messages', MessageControllerAlias::class . ':sendMessage');
    // $group->get('/groups/{group_id}/messages', MessageControllerAlias::class . ':getMessage');
    
    // User endpoints
    // $group->post('/users', UserControllerAlias::class . ':createUser');
    // $group->get('/users', UserControllerAlias::class . ':getUsers');
    
    // // UserGroup endpoints
    // $group->post('/groups/{group_id}/join', UserGroupControllerAlias::class . ':joinGroup');
    
});
};