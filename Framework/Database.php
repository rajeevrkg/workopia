<?php

namespace Framework;
use PDO;
use PDOException;
use Exception;
class Database{
    public $conn;

    /**
     * Constructor for Database connection
     * @param array $config
     */

    public function __construct($config){
        $dsn = "mysql:host={$config['host']}; port={$config['port']}; dbname={$config['dbname']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try{
            $this->conn = new PDO($dsn, $config['username'], $config['password'],$options);
        }catch (PDOException $e){
            throw new Exception("Database connection failed: {$e->getMessage()}");
        }
    }

    /**
     * Query Database
     * @param string $query
     * @return PDOStatement
     * @throws PDOException
     */
    public function query($query, $params = []){
        try{
            $stmt = $this->conn->prepare($query);
            foreach($params as $param => $value){
                $stmt->bindParam(':'.$param,$value);
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e){
            throw new Exception("Query failed to execute:". $e->getMessage(''));
        }
    }

} 
?>