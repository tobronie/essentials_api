<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_info`, `judul_info`, `kategori_info`, `isi_info`, `foto_info`, `tgl_upload_info` FROM `information`";
$exe = mysqli_query($con, $query);

$arr=[];

while($row = mysqli_fetch_assoc($exe))
{
    $arr[] = $row;
}

print(json_encode($arr));

?>