<?php

/*
 * PDO DB CLASS
 *
 * Connect to DB
 *
 * Create Prepared statements
 *
 * Bind Values
 *
 * Return rows and results
 *
 */
class Database
{
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $host_name = DB_HOST;
    private $db_name = DB_NAME;
    private $db_handler;
    private $db_stmt;
    private $db_error;

    public function __construct()
    {
        // SET dsn

        $dsn = 'mysql:host=' . $this->host_name . ';dbname=' . $this->db_name;
        $options = array(
            PDO::ATTR_PERSISTENT => true,  // for speed
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );



        try{

            $this->db_handler = new PDO($dsn, $this->username, $this->password, $options);

        }catch (PDOException $e)
        {
            $this->db_error = $e->getMessage();

            echo $this->db_error;
        }
    }


    // Prepare statement with query
    public function query($sql)
    {
        $this->db_stmt = $this->db_handler->prepare($sql);
    }


    // Bind values
    public function bind($param, $value, $type='')
    {
        if($type == null)
        {
            switch (true)
            {
                case is_numeric($type):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($type):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($type):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->db_stmt->bindValue($param, $value, $type);
    }


    // Execute the prepared statement
    public function execute()
    {
        if($this->db_stmt->execute()){
            return true;
        }
    }


    // Get Result set as array of objects

    public function resultSet()
    {
        $this->execute();

        return $this->db_stmt->fetchAll(PDO::FETCH_OBJ); // to get array of objects
    }


    // Get single record Result set as object
    public function singleResultSet()
    {
        $this->execute();
        return $this->db_stmt->fetch(PDO::FETCH_OBJ);
    }


    public function rowCount()
    {
        return $this->db_stmt->rowCount(); // default function in PDO to get rows count
    }

}