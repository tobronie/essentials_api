<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_ktp`, `kt_judul`, `kt_foto_akte`, `kt_foto_kk`, `kt_foto_formulir`, `kt_surat_konfirmasi`,
    `kt_tgl_upload`, `kt_konfirmasi`
    FROM `ktp`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>