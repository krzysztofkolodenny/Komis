<?php
include('base.php');

if( isSet( $_POST['nazwa'] ) ) {
    $id = isset($_POST['$id'])? intval($_POST['id']): 0;
    if($id>0){
    $sth = $pdo->prepare('UPDATE `samochod` SET `id`=:id,`nazwa`=:nazwa,`rok_produkcji`=:rok_produkcji,`cena`=:cena, WHERE id=:id');
    }
    $sth = $pdo->prepare('INSERT INTO `samochod`(`nazwa`, `rok_produkcji`, `cena`) VALUES (:nazwa,:rok_produkcji,:cena)');
    $sth->bindParam(':nazwa', $_POST['$nazwa']);
    $sth->bindParam(':rok_produkcji', $_POST['$rok_produkcji']);
    $sth->bindParam(':cena', $_POST['$cena']);
    $sth->execute();
    header('location: loop.php');
}
 $idGet=isSet($_GET['id'])  ? intval($_GET['id']): 0;
if($idGet>0){
    $sth=$pdo->prepare('SELECT * FROM `komis` WHERE id=:id');
    $sth->bindParam(':id',$idGet);
    $sth->execute();
    $result=$sth->fetch();
}
?>

<form method="post" action="add.php">
    Nazwa:<input type="text" name="nazwa"> <br> <br>
    Rok produkcji: <input type="number" name="rok_produkcji"> <br> <br>
    Cena:<input type="number" name="cena"> <br> <br>
    <input type="submit" value="Zapisz">
</form>