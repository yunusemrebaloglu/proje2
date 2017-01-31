
<?php
// bu sayfada fotoğrafın kaydedilmesini yaptık

require_once '../init.php';
engel();
// formdan photo isimli alandan dosya geldimi bakalım
if (isset($_FILES['photo'])) {
    // dosya geldiyse fotoğraf olduğundan emin olalım


    if ($_FILES['photo']){
        if ($_FILES["photo"]["size"]<1024*1024){//Dosya boyutu 1Mb tan az olsun

            if ($_FILES["photo"]["type"]=="image/png" || $_FILES["photo"]["type"]=="image/jpg" || $_FILES["photo"]["type"]=="image/jpeg" || $_FILES["photo"]["type"]=="image/gif" ){
                //dosya tipi jpeg olsun

                //fotoğraf ise yeni bir isim verelim, "photos/" dizinimize kaydedelim
                $uploadPath = "photos";

                $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

                $newName = sha1(md5(uniqid())) . "." . $extension;

                $destination = $uploadPath . "/" . $newName;


                $isUploaded = move_uploaded_file($_FILES['photo']['tmp_name'], $destination);

                // eğer kendi dizinimize kaydetme başarılı olursa ismini ve bu ekleme işlemini yapan kullanıcının bilgilerini,
                //eklenme tarihi ile birlikte veritabanına yazalım
                if ($isUploaded) {
                    // ekleme sorgumuzu oluşturalım
                    $add =  $connection -> prepare("INSERT INTO media (user_id, path, uploaded_at) VALUES (?, ?, ?)");
                    $isadd = $add ->execute([$_SESSION['id'], $newName, date('d.m.Y H:i ') ]);

                    if ($isadd) {
                        echo 'BAŞARI İLE EKLENDİ';


                    }
                }
            }

        }
    }
}
header("Location: index.php");

// video kaynak bilgi / uğur arıcı youtube sayfası.
?>

