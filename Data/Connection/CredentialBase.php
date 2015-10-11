<?php
/**
 * Created by PhpStorm.
 * User: ramon.costa
 * Date: 09/10/2015
 * Time: 11:49
 */

class CredentialBase implements ICredentials
{
    private $username;
    private $password;
    private $hostname;
    private $hostport;
    private $catalog;
    private $provider;

    
    public function setUserName($i)
    {
        $this->username = $i;
    }

    public function setPassword($i)
    {
        $this->password = $i;
    }

    public function setHost($i)
    {
        $this->hostname = $i;
    }

    public function setHostPort($i)
    {
        $this->hostport = $i;
    }

    public function setCatalog($i)
    {
        $this->catalog = $i;
    }

    public function setProvider($i)
    {
        $this->provider = $i;
    }

    public function getUserName()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getHost()
    {
        return $this->hostname;
    }

    public function getHostPort()
    {
        return $this->hostport;
    }

    public function getCatalog()
    {
        return $this->catalog;
    }

    public function getProvider()
    {
        return $this->provider;
    }
}