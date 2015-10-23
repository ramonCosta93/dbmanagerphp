<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 12/10/2015
 * Time: 13:00
 */

class ContextEntityBase implements IContextEntity
{
    private $entityName;
    private $_arrayObjectColumns = array();

    public function __construct(IConnect $connect, $entity)
    {
        $this->entityName = $entity;

        $this->setEntity($connect);
    }

    private function setEntity(IConnect $dbAccess)
    {
        $dbAccess->prepare("SELECT * FROM
                                  INFORMATION_SCHEMA.COLUMNS
                                 WHERE TABLE_NAME = :TABLE_NAME
                                       AND TABLE_SCHEMA = :TABLE_SCHEMA");

        $dbAccess->addParameter(array(':TABLE_NAME' => $this->entityName,
                                             ':TABLE_SCHEMA' => $dbAccess->getCatalog()));

        foreach($dbAccess->execute()->fetchAll(PDO::FETCH_ASSOC) as $item)
        {
            $this->$item["COLUMN_NAME"] = $item["COLUMN_NAME"];
            $this->_arrayObjectColumns[] = $item["COLUMN_NAME"];
        }
    }

    public function getEntityName()
    {
        return $this->entityName;
    }

    public function getPropertysColumns()
    {
        foreach($this->_arrayObjectColumns as $prop)
            $var[$prop] = $this->$prop;
        return $var;
    }
}