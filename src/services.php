<?php
use \FKK\services\UserService;

$container = $app->getContainer();

$container['userService'] = function ($container) {
    return new UserService($container);
};