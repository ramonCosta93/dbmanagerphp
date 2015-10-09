<?php
/**
 * Created by PhpStorm.
 * User: ramon.costa
 * Date: 09/10/2015
 * Time: 11:02
 */

class ConnectionBase implements IConnect{

    private $db;

    public function __construct(ICredentials $credentials)
    {
        $this->db = $this->connection($credentials);
    }

    public function prepare($statement)
    {
        // TODO: Implement prepare() method.
    }

    public function connection(ICredentials $credentials)
    {
        $this->db = new PDO(
                            "mysql:host=".$credentials->getHost().
                            ";port=".$credentials->getHostPort().
                            ";dbname=".$credentials->getCatalog()
                            ,$credentials->getUserName()
                            ,$credentials->getPassword()
                           );

    }

    public function query()
    {
        // TODO: Implement query() method.
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }

    public function addParameter()
    {
        // TODO: Implement addParameter() method.
    }

    public function getError()
    {
        // TODO: Implement getError() method.
    }
}