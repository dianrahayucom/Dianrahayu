<?php

include ('crudmk.php');

    $kode = $_GET['kode'];

    $hasil = hapusMt($kode);

    if ($hasil == true){
        header("Location: hapusmk.php");
    } else {
        echo "gagal hapus record";
    }

?>