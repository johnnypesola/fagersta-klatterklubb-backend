<?php
use \FKK\repositories\UserRepository;

$container = $app->getContainer();

$container['userRepository'] = function ($container) {
    return new UserRepository($container);
};