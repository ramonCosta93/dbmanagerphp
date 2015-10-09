<?php
/**
 * Created by PhpStorm.
 * User: ramon.costa
 * Date: 09/10/2015
 * Time: 11:03
 */

interface IConnect
{
    public function prepare($statement);
    public function connection(ICredentials $credentials);
    public function query($statement);
    public function execute();
    public function addParameter(array $params);
    public function getError();
}