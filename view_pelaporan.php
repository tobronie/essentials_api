<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_lapor`, `judul_lapor`, `waktu_lapor`, `lokasi_lapor`, `isi_lapor`, `foto_lapor`, `tgl_upload_lapor`
FROM `pelaporan`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>