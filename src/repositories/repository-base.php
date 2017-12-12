<?php

namespace FKK\repositories;
use PDO;

abstract class RepositoryBase
{
    private $connectionSettings;
    protected $dbConnection;

    public function __construct(\Slim\Container $container) {
        $this->connectionSettings = $container->get('settings')['dbConnection'];
        $this->CreateTableWithFieldsIfNotExists();
    }

    protected function CreateDbConnection(){
        $this->dbConnection = new PDO(
            $this->connectionSettings['dsn'],
            $this->connectionSettings['user'],
            $this->connectionSettings['password']
        );

        $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    protected function CloseConnection() {
        $this->dbConnection = null;
    }

    protected function CreateTableWithFieldsIfNotExists() {
        
        if(sizeof($this->tableFields) !== sizeof($this->tablefieldTypes)){    
            throw new Exception("Fields array and fieldtypes array must be of same length.");
        }
        
        $fieldsQuery = "`id` int(11) NOT NULL auto_increment, ";
        for($i = 0; $i < sizeof($this->tableFields); $i++){
            $fieldsQuery .= "`" . $this->tableFields[$i] . "` " . $this->tablefieldTypes[$i] . ", ";
        }
        $fieldsQuery .= " PRIMARY KEY (`id`)";

        $query = "CREATE TABLE IF NOT EXISTS `" . $this->tableName . "` (" . $fieldsQuery . ")";

        $this->ExecuteQuery($query);
    }

    protected function GetAllAsObj() {
        
        $this->CreateDbConnection();

        $statement = $this->dbConnection->prepare("SELECT * FROM `$this->tableName`");
        $statement->execute();
    
        $result = $statement->fetch(PDO::FETCH_LAZY);

        return $result;
    }

    private function ExecuteQuery($query) {
        $this->CreateDbConnection();
        $result = $this->dbConnection->exec($query);
        $this->CloseConnection();
    }
}