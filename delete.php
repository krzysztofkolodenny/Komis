<?php
include ('base.php');
//first solution
$id=isSet($_GET['id']) ? intval($_GET['id']) :0;
//second solultion
if($id>0){
    $sth=$pdo->prepare('DELETE FROM samochod WHERE id=:id');
    $sth->bindParam(':id',$_POST['id']);
    $sth->bindParam(':nazwa',$_POST['nazwa']);
    $sth->bindParam(':rok_produkcji',$_POST['rok_produkcji']);
    $sth->bindParam(':cena',$_POST['cena']);
    $sth->execute();

header('location: loop.php');
}else{
header('location: loop.php');

}