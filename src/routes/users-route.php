<?php

use Slim\Http\Request;
use Slim\Http\Response;
use \FKK\services\UserService;
use \FKK\models\User;

$app->get('/users/[{username}]', function (Request $request, Response $response, array $args) {
    
    // Log message
    $this->logger->info("'/' route");

    // Get content
    $userName = $args['username'];

    // Do magic
    $users = $this->userService->GetAll();

    return $response->withJson(
        array(
            'status' => 'user',
            'username' => $userName,
            'users' => $users
        ),
        200
    );
});

$app->post('/users/new', function (Request $request, Response $response) {

    $data = $request->getParsedBody();

    try {
        $user = new User(
            null,
            $data['username'],
            $data['firstname'],
            $data['surname'],
            $data['password']
        );

        $this->userService->

        // return $response->withJson(
        //     array(
        //         'user' => [
        //             'firstname' => $user->GetFirstName()
        //         ]
        //     ),
        //     200
        // );

    } catch (\Exception $e) {
        return $response->withJson(
            array(
                'error' => $e->getMessage()
            ),
            400
        );
    }




});