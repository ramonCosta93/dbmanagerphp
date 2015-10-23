<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 19/10/2015
 * Time: 19:42
 */

class ContextDAOBase
{
    private $_dbAccess;
    private $_entity;

    public function __construct(IConnect $connect, IContextEntity $entity)
    {
        $this->_dbAccess = $connect;
        $this->_entity = $entity;
    }
    public function Add()
    {
        $insert = "INSERT INTO <TABLE>(<COLUMNS>) VALUES(<VALUES>)";
        $insert = str_replace("<TABLE>",$this->_entity->getEntityName(),$insert);
        $insert = str_replace("<COLUMNS>",implode(', ',array_keys($this->_entity->getPropertysColumns())),$insert);
        $values = array();
        foreach($this->_entity->getPropertysColumns() as $prop => $v)
            $values[":".$prop] = $this->_entity->$prop;

        echo $insert = str_replace("<VALUES>",implode(' , ',array_keys($values)),$insert);

        $this->_dbAccess->prepare($insert);
        $this->_dbAccess->addParameter($values);
        $this->_dbAccess->execute();
    }

    public function Update()
    {
        $update = "UPDATE <TABLE> SET <VALUES> WHERE <PREDICATE>";
        $update = str_replace("<TABLE>",$this->_TABLE_NAME,$update);
        $values = array();
        foreach($this->_columnsArrayParams as $prop)
            $values[] = $prop."=".$this->quote($this->$prop);
        $update = str_replace("<VALUES>",implode(' , ',$values),$update);
        $predicate = array();
        foreach($this->_columnsPkArray as $pk)
            $predicate[] = $pk."=".$this->quote($this->$pk);
        $update = str_replace("<PREDICATE>",implode(' , ',$predicate),$update);
        $this->prepare($update);
        $this->execute();
    }

    public function Delete()
    {
        $delete = "DELETE FROM <TABLE> WHERE <PREDICATE>";
        $delete = str_replace("<TABLE>",$this->_TABLE_NAME,$delete);
        $predicate = array();
        foreach($this->_columnsPkArray as $pk)
            $predicate[] = $pk."=".$this->quote($this->$pk);
        $delete = str_replace("<PREDICATE>",implode(' , ',$predicate),$delete);
        $this->prepare($delete);
        $this->execute();
    }

    public function FindAll()
    {
        return $this->query("SELECT * FROM $this->_TABLE_NAME" )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function FindByID()
    {
        $select = "SELECT * FROM <TABLE> WHERE <PREDICATE>";
        $select = str_replace("<TABLE>",$this->_TABLE_NAME,$select);
        $predicate = array();
        foreach($this->_columnsPkArray as $pk)
            $predicate[] = $pk."=".$this->quote($this->$pk);
        $select = str_replace("<PREDICATE>",implode(' , ',$predicate),$select);
        return $this->query($select)->fetchAll(PDO::FETCH_ASSOC);
    }

}