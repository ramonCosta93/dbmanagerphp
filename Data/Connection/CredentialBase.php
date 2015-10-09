<?php
/**
 * Created by PhpStorm.
 * User: ramon.costa
 * Date: 09/10/2015
 * Time: 11:49
 */

class CredentialBase implements ICredentials
{
    
    public function setUserName()
    {
        return "root";
    }

    public function setPassword()
    {
        return "";
    }

    public function setHost()
    {
        return "127.0.0.1";
    }

    public function setHostPort()
    {
        return "3306";
    }

    public function setCatalog()
    {
        return "adventureworks";
    }

    public function setProvider()
    {
        return "mysql";
    }

    public function etUserName()
    {
        return "root";
    }

    public function getPassword()
    {
        return "";
    }

    public function getHost()
    {
        return "127.0.0.1";
    }

    public function getHostPort()
    {
        return "3306";
    }

    public function getCatalog()
    {
        return "adventureworks";
    }

    public function getProvider()
    {
        return "mysql";
    }
}