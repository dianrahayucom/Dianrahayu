<?php
require_once 'koneksi.php';

// membaca (select) tabel matakuliah
// jika berhasil, hasil array dr baris-baris data
// dan setiap baris data berupa array dari nama-nama field
// jika tidak ada, hasil berupa nilai null
function bacaMtKuliah($sql) {
    $data = array();
    $koneksi = koneksiAkademik();
    $hasil = mysqli_query($koneksi, $sql);

    // jika tidak ada record, hasil berupa null
    if (mysqli_num_rows($hasil) == 0) {
        mysqli_close($koneksi);
        return null;
    }

    $i=0;
    while($baris = mysqli_fetch_assoc($hasil)) {
        $data[$i]['kode']= $baris['kode'];
        $data[$i]['nama'] = $baris['nama'];
        $data[$i]['sks'] = $baris['sks'];
        $i++;
    }

    mysqli_close($koneksi);
    return $data;
}

// menambah (create) record
// data baru berupa kode nama, sks
// dimasukkan dalam parameter fungsi
function tambahMtkKuliah($kode, $nama, $sks) {
    $koneksi = koneksiAkademik();
    $sql = "insert into matakuliah values('$kode', '$nama', '$sks')";
    $hasil = 0;

    if (mysqli_query($koneksi, $sql)) {
        $hasil = 1;
        mysqli_close($koneksi);

        return $hasil;
    }
}
// menambahkan fungsi "hapusMtkKuliah" berdasarkan kode
function hapusMt($kode) {
    $koneksi = koneksiAkademik();
    $sql = "delete from matakuliah where kode='$kode'";

    if (mysqli_query($koneksi, $sql)) {
        $hasil = true;
    } else {
        $hasil = "Error menghapus record: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
    return $hasil;
}