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
    public function query();
    public function execute();
    public function addParameter();
    public function getError();
}