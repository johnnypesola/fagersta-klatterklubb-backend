<?php

namespace services;

abstract class RepositoryBase
{
    private $_SQL_FILE_LOCATION = './database.sqlite';
    protected $dbConnection;

    protected function CreateDb(){
        this::$dbConnection = new SQLite3(this::$_SQL_FILE_LOCATION);
    }

    protected function CreateTableWithFieldsIfNotExist(string $tableName, array $fields, array $fieldTypes) {
        
        if(sizeof($fields) !== sizeof($fieldTypes)){    
            throw new Exception("Fields array and fieldtypes array must be of same length.");
        }
        
        $fieldsQuery = "";

        for($i = 0; $i < sizeof($fields); $i++){
            $fieldsQuery .= $fields[$i] . " " . $fieldTypes[i];

            if($i + 1 !== sizeof($fields)){
                $fieldsQuery .= ", ";
            }
        }

        this::$dbConnection->exec("CREATE TABLE IF NOT EXISTS" . $tableName . " " . $fieldsQuery);
    }
}