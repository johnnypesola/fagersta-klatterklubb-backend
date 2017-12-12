<?php
namespace FKK\services;

class UserService {

    private $userRepository;

    public function __construct(\Slim\Container $container) {

        $this->userRepository = $container->get('userRepository');
    }

    public function GetAll() {
        return $this->userRepository->GetAll();
    }

    public function SaveUser(\FKK\models\User $user) {
        $this->userRepository->Save($user);
    }
}