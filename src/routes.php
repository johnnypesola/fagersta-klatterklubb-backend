<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {

    // Sample log message
    $this->logger->info("'/' route");

    return $response->withStatus(400);
});