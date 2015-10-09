<?php
/**
 * Created by PhpStorm.
 * User: ramon.costa
 * Date: 09/10/2015
 * Time: 11:03
 */

interface ICredentials
{
    public function getUserName();
    public function getPassword();
    public function getHost();
    public function getHostPort();
    public function getCatalog();
    public function getProvider();
}