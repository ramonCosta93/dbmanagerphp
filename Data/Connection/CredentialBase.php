<?php
/**
 * Created by PhpStorm.
 * User: ramon.costa
 * Date: 09/10/2015
 * Time: 11:49
 */

class CredentialBase implements ICredentials
{
    public function getUserName()
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