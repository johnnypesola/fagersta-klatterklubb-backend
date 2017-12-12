<?php

namespace services;

class UsersService extends RepositoryBase {

    private $tableName = "users";
    private $tableFields = ["username", "password", "firstName", "lastName"];
    private $tablefieldTypes = ["STRING", "STRING", "STRING", "STRING"];

    public function __construct() {

        CreateTableWithFieldsIfNotExist(
            this::$tableName, 
            this::$tableFields, 
            this::$tablefieldTypes
        );
    }
}