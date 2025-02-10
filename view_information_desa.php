<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `judul_infodes`, `isi_infodes`, `foto_infodes`, `tgl_upload_infodes` FROM `information_desa`";
$exe = mysqli_query($con, $query);

$arr=[];

while($row = mysqli_fetch_array($exe))
{
    $arr[] = $row;
}

print(json_encode($arr));

?>