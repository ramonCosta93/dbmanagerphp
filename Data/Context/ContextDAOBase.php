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
    private $_predicate = array();

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

        $insert = str_replace("<VALUES>",implode(' , ',array_keys($values)),$insert);

        $this->_dbAccess->prepare($insert);
        $this->_dbAccess->addParameter($values);
        $this->_dbAccess->execute();

    }

    public function Update(array $predicateArray, array $valuesSet)
    {

        $update = "UPDATE <TABLE> SET <VALUES> WHERE <PREDICATE>";
        $update = str_replace("<TABLE>",$this->_entity->getEntityName(),$update);
        $values = array();
        foreach($valuesSet as $prop => $v)
            $values[] = $prop."=".$this->_dbAccess->quote($v);

        $update = str_replace("<VALUES>",implode(' , ',$values),$update);

        foreach($predicateArray as $prop => $vl)
            $predicate[] = $prop."=".$this->_dbAccess->quote($vl);


        echo $update = str_replace("<PREDICATE>",implode(' and ',$predicate),$update);

        $this->_dbAccess->prepare($update);
        $this->_dbAccess->execute();

    }

    public function Delete(array $predicateArray)
    {
        $delete = "DELETE FROM <TABLE> WHERE <PREDICATE>";
        $delete = str_replace("<TABLE>",$this->_entity->getEntityName(),$delete);
        $predicate = array();
        foreach($predicateArray as $prop => $vl)
            $predicate[] = $prop."=".$this->_dbAccess->quote($vl);
        $delete = str_replace("<PREDICATE>",implode(' and ',$predicate),$delete);
        $this->_dbAccess->prepare($delete);
        $this->_dbAccess->execute();
    }

    public function findAll()
    {
        return $this->query("SELECT * FROM $this->_TABLE_NAME" )->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByID(array $predicate = null)
    {
        $this->setPredicate($predicate);

        $select = "SELECT * FROM <TABLE> WHERE <PREDICATE>";
        $select = str_replace("<TABLE>",$this->_entity->getEntityName(),$select);
        $predicate = array();
        foreach($this->_predicate as $pk => $vl)
        {
            $predicate[] = $pk .' = '.$vl;
            $parameter[':'.$pk] = $vl;
        }
        $select = str_replace("<PREDICATE>",implode(' , ', $predicate),$select);
        $this->_dbAccess->prepare($select);
        $this->_dbAccess->addParameter($parameter);

        return $this->_dbAccess->execute()->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setPredicate(array $predicate)
    {
        if(count($predicate) <= 0)
            throw new Exception("Argumento inválido. è necessário um array com o predicate");

        $this->_predicate = $predicate;
    }

    public function bindObject(array $array)
    {
        foreach($array as $prop => $key)
            if(is_array($key))
                foreach($key as $p => $k)
                    $this->_entity->$p = $k;
            else
                $this->_entity->$prop = $key;
        return $this->_entity;
    }
}