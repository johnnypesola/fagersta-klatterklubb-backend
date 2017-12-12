<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/pages/[{name}]', function (Request $request, Response $response, array $args) {
    
    // Log message
    $this->logger->info("'/' route");

    // Get content
    $page_name = $args['name'];

    return $response->withJson(
        array(
            'status' => 'page',
            'name' => $page_name
        ),
        200
    );
});