<?php
use \FKK\models\User;

namespace FKK\repositories;

class UserRepository extends \FKK\repositories\RepositoryBase {
    
    protected $tableName = "users";
    protected $tableFields = ["username", "password", "firstname", "lastname"];
    protected $tablefieldTypes = ["varchar(200)", "varchar(200)", "varchar(200)", "varchar(200)"];

    public function __construct(\Slim\Container $container) {

        parent::__construct($container);
    }

    public function GetAll() {
        $users = $this->GetAllAsObj();
        
        if($users) {
            foreach($users as $user) {
                print_r($user);
            }
        }
    }

    public function SaveUser(\FKK\models\User $user) {
        
    }
}