<?php
//aşağıdaki fonksiyonda eğer bir session varsa tarayıcı üzerinde giriş yaparken bu sessiona verilen özel katagoriye göre id verildi
//bu özelid eğer session olup en baştaki kaydola falan tıklamaya kalkarsa  olduğu yere götürüyor.
function ozelid () {
if($_SESSION){
    if ($_SESSION['ozelid'] == 1){
        header('Refresh:0; url= sirketler/index.php');
    } elseif ($_SESSION['ozelid'] == 2){
        header('Refresh: 0; url=isciler/index.php');
    }
}

                        }
// bu fonksiyonun yukarıdakinden farkı ise yukarıdaki katagorinin index sayfasında hata vermesinden kaynaklıdır.
// yine özel id nimetini kullanarak yönlendirme yaptım aşağıdaki iki fonksiyonda da
function sadeceisci () {

    if($_SESSION){
        if ($_SESSION['ozelid'] == 1){
            header('Refresh:0; url= sirketler/index.php');
        } elseif ($_SESSION['ozelid'] == 2){ }
    } else header('Refresh:0; url=../index.php');
}
function sadecesirket () {

    if($_SESSION){
        if ($_SESSION['ozelid'] == 2){
            header('Refresh:0; url= isciler/index.php');
        } elseif ($_SESSION['ozelid'] == 1){  }
    } else header('Refresh:0; url=../index.php');
}

        // tarihi her sayfanın başında çağıralım
        date_default_timezone_set('Europe/Istanbul');



        // yüklenen dosya bir fotoğraf mı diye bakalım
        function isUploadedFileAnImage($uploadedFile, $approvedMineTypes = [" image/png","image/jpg"]){
            if( ! $size = getimagesize($uploadedFile['tmp_name'])) return false;
            if( $size['mine'] !== $uploadedFile['type'] ) return false;
            if ( in_array($size['mine'], $approvedMineTypes) ) return false;
            return true;
        }


        //dd
function dd($any){
            echo"<pre>";
            var_dump($any);
            echo "</pre>";
            die();
}

function engel(){
    if (!empty($_SESSION['engel'])) {
        header("Location: die.php");
    }

}




?>