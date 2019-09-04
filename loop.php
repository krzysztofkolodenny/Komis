<?php
include ('base.php');
echo 'Lista samochodów:'.'<br>';
$tab=$pdo->query('SELECT * FROM `samochod`');
echo '<br> <a href="add.php">Dodaj samochód</a> </br>';
echo '<table border="1">';
echo '<tr>';
echo '<th>id</th>';
echo '<th>nazwa</th>';
echo '<th>rok produkcji</th>';
echo '<th>cena</th>';
echo '<th>opcje</th>';
echo '</tr>';
foreach ($tab->fetchAll() as $value){
        echo '<tr>';
        echo '<td>'.$value['id'].'</td>';
        echo '<td>'.$value['nazwa'].'</td>';
        echo '<td>'.$value['rok_produkcji'].'</td>';
        echo '<td>'.$value['cena'].'</td>';
        echo '<td> <a href="delete.php?id=' .$value['id'].'">Usuń</a> | <a href="add.php?id= '.$value['id'].'">Edytuj</a> </td>';
        echo '</tr>';
}



echo '</table>';