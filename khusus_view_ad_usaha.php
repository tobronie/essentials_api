<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_usaha`, `us_judul`, `us_foto_ktp`, `us_foto_kk`, `us_omset`, `us_surat_konfirmasi`, `us_tgl_upload`,
    `us_konfirmasi`
    FROM `usaha`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>