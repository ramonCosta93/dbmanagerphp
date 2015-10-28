<?php
include("../Util/includes.php");

$credentials = new CredentialBase();

$credentials->setCatalog("adventureworks");
$credentials->setHost("127.0.0.1");
$credentials->setHostPort(3306);
$credentials->setProvider("mysql");
$credentials->setUserName("root");
$credentials->setPassword("");

$con = new ConnectionBase($credentials);
$context = new ContextBase($con);

$testeEntity = $context->getEntity("teste");
$testeEntity->nome = "Teste Locao";


$dao = new ContextDAOBase($con,$testeEntity);

$dao->Update(array('id' => 231), array('nome' => 'Teste Loco Demais'));
$dao->Delete(array('id' => 231));



//$dao->Add();

//var_dump($context->getEntity("teste")->getPropertysColumns());

/*
$con->prepare("INSERT INTO teste VALUES(:id, :nome)");
$con->addParameter(array(":id" => 32 , ":nome" => "Ronaldo Santos"));
$con->execute();

var_dump($con->query("SELECT * FROM teste")->fetchAll(PDO::FETCH_ASSOC));
  */