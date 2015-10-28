<?php
/**
 * Created by PhpStorm.
 * User: ramon.costa
 * Date: 09/10/2015
 * Time: 11:02
 */

class ConnectionBase implements IConnect{

    private $_db;
    private $_prepared;
    private $_params;
    private $_database;

    public function __construct(ICredentials $credentials)
    {
       $this->_database = $credentials->getCatalog();

       $this->connection($credentials);
    }

    public function prepare($statement)
    {
        $this->_prepared = $this->_db->prepare($statement,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    }

    public function connection(ICredentials $credentials)
    {
        $this->_db = new PDO(
                            "mysql:host=".$credentials->getHost().
                            ";port=".$credentials->getHostPort().
                            ";dbname=".$credentials->getCatalog()
                            ,$credentials->getUserName()
                            ,$credentials->getPassword()
                           );
    }

    public function query($statement)
    {
        return $this->_db->query($statement);
    }

    public function execute()
    {
        $return = $this->_prepared->execute($this->_params);
        //echo $this->_prepared->rowCount();
        //echo $this->_prepared->queryString;
        if($return === false)
        {
            throw new PDOException( $this->_prepared->errorInfo()[2],$this->_prepared->errorInfo()[1] );

        }
        return $this->_prepared;
    }

    public function addParameter(array $params)
    {
        $this->_params = $params;
    }

    public function getError()
    {
        // TODO: Implement getError() method.
    }

    public function getCatalog()
    {
        return $this->_database;
    }

    public function quote($str)
    {
        return $this->_db->quote($str);
    }
}