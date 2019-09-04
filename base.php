<?php
try{
$pdo = new PDO('mysql:host=localhost;dbname=komis;encoding=utf8','root');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}catch (PDOException $e){
    $e->getMessage('ERROR');

}