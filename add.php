<?php
include('base.php');

if( isSet( $_POST['nazwa'] ) ) {
    $sth = $pdo->prepare('INSERT INTO `samochod`(`nazwa`, `rok_produkcji`, `cena`) VALUES (:nazwa,:rok_produkcji,:cena)');
    $sth->bindParam(':nazwa', $_POST['$nazwa']);
    $sth->bindParam(':rok_produkcji', $_POST['$rok_produkcji']);
    $sth->bindParam(':cena', $_POST['$cena']);
    $sth->execute();
}
?>

<form method="post" action="add.php">
    Nazwa:<input type="text" name="nazwa"> <br> <br>
    Cena:<input type="number" name="cena"> <br> <br>
    Rok produkcji: <input type="number" name="rok_produkcji"> <br> <br>
    <input type="submit" value="Zapisz">
</form>