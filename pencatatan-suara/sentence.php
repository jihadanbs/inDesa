<?php

/**
 * Returns num-th sentence of given dataset
 */

$ds = $_GET['ds'] ;
$num = $_GET['num'] ;

if ($num < 0) {
    echo "1. Masukkan Nomer Data Suara Untuk Hasil Rekaman Nantinya (AGAR LEBIH TERTATA RAPIH) <br>";
    echo "2. Jika Data Sumber dan Kegunaan Sama Pastikan Saat Menulis Tidak TYPO (TIDAK SALAH TULIS) <br>";
    echo "Agar Data Tersebut Masuk Kedalam Folder Yang Sama";
    return;
}

$file = 'data/' . $ds;

if ($num > intval(exec("wc -l '$file'"))) {
    echo "Pastikan Data Nomor Sesuai Keinginan";
    return;
}


if (!file_exists($file))
    echo 'ERROR: data sudah ada!';
else {
    $spl = new SplFileObject($file);
    $spl->seek($num);
    echo $spl->current();
}
?>