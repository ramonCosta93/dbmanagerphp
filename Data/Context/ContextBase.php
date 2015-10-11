<?php

class ContextBase
{
    private $_dbAcces;

    public function __construct(IConnect $conect)
    {
       $this->_dbAcces = $conect;
       $this->setEntities();
    }

    private function setEntities()
    {
       $this->_dbAcces->prepare(" SELECT DISTINCT TABLE_NAME FROM
                                  INFORMATION_SCHEMA.TABLES
                                 WHERE TABLE_SCHEMA = :TABLE_SCHEMA");

       $this->_dbAcces->addParameter(array(':TABLE_SCHEMA' => 'adventureworks'));

       $tablesArray = $this->_dbAcces->execute()->fetchAll();

       foreach($tablesArray as $table)
       {
           $this->$table["TABLE_NAME"] = $table["TABLE_NAME"];
       }
    }
}
