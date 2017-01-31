<?php
require_once "../init.php"; engel();
$kim = $_SESSION['id'];
$photos = $connection->query("SELECT * FROM medias WHERE user_id = $kim")->fetch();
//fotoğrafı silip yerine yenisini yükleyeceğiz
$eskiadi = $photos['path'];
unlink("photos/$eskiadi");


if(isset($_POST['idToDelete'])){
    $idToDelete = (int)$_POST['idToDelete'];

    // DELETE FROM students WHERE id = $idToDelete
    $deleteQuery = $connection->prepare("DELETE FROM medias WHERE id = ?");
    $isDeleted = $deleteQuery->execute([$idToDelete]);

    echo 'BAŞARIYLA SİLİNDİ';
}


header("Location: fotoguncelle.php");