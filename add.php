<?php
include( 'session.php' );
if( isSet( $_POST['nazwa'] ) ) {
    $id = isSet( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
    $fileName = 0;
    if( isSet( $_FILES['cover']['error'] ) && $_FILES['cover']['error'] == 0 ) {
        require( "vendor/autoload.php" );
        $uid = uniqid();
        $ext = pathinfo( $_FILES['cover']['name'], PATHINFO_EXTENSION );
        $fileName = 'cover_' . $uid . '.' . $ext;
        $fileNameOrg = 'org_' . $uid . '.' . $ext;
        $imagine = new Imagine\Gd\Imagine();
        $size    = new Imagine\Image\Box(200, 200);
        //$mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
        $mode    = Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;
        $imagine->open( $_FILES['cover']['tmp_name'] )
            ->thumbnail( $size, $mode )
            ->save( __DIR__ . '/img/' . $fileName );
        move_uploaded_file( $_FILES['cover']['tmp_name'], __DIR__ . '/img/' . $fileNameOrg );
    }
    if( $id > 0 ) {
        if( $fileName ) {
            $sth = $pdo->prepare( 'UPDATE `komis` SET `nazwa`=:nazwa,`rok_produkcji`=:rok_produkcji,`cena`=:cena,cover=:cover WHERE id = :id' );
            $sth->bindParam( ':cover', $fileName );
            $sthCov = $pdo->prepare( 'SELECT cover FROM komis WHERE id = :id' );
            $sthCov->bindParam( ':id', $id );
            $sthCov->execute();
            $cover = $sthCov->fetch()['cover'];
            if( $cover ) {
                unlink( __DIR__ . '/img/' . $cover );
                unlink( __DIR__ . '/img/' . str_replace( 'cover_', 'org_', $cover ) );
            }
        } else {
            $sth = $pdo->prepare( 'UPDATE `komis` SET `nazwa`=:nazwa,`rok_produkcji`=:rok_produkcji,`cena`=:cena,WHERE id = :id' );
        }
        $sth->bindParam( ':id', $id );
    } else {
        $sth = $pdo->prepare( 'INSERT INTO `komis`(`nazwa`, `rok_produkcji`, `cena`) VALUES ( :nazwa, :rok_produkcji, :cena)' );
        if( $fileName ) {
            $sth->bindParam( ':cover', $fileName );
        }
    }
    $sth->bindParam( ':nazwa', $_POST['nazwa'] );
    $sth->bindParam( ':rok_produkcji', $_POST['rok_produkcji'] );
    $sth->bindParam( ':cena', $_POST['cena'] );
    $sth->execute();
    header( 'location: loop.php' );
}
$idGet = isSet( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
if( $idGet > 0 ) {
    $sth = $pdo->prepare( 'SELECT * FROM komis WHERE id = :id' );
    $sth->bindParam( ':id', $idGet );
    $sth->execute();
    $result = $sth->fetch();
}
?>
<form method="post" action="add.php">
    Nazwa:<input type="text" name="nazwa"> <br> <br>
    Rok produkcji: <input type="number" name="rok_produkcji"> <br> <br>
    Cena:<input type="number" name="cena"> <br> <br>
    <input type="submit" value="Zapisz">
</form>