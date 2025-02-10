<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["judul_info"])) {
    $judul_info = $_POST["judul_info"];
} else
    return;

if (isset($_POST["kategori_info"])) {
    $kategori_info = $_POST["kategori_info"];
} else
    return;

if (isset($_POST["isi_info"])) {
    $isi_info = $_POST["isi_info"];
} else
    return;

if (isset($_POST["foto_info"])) {
    $foto_info = $_POST["foto_info"];
} else
    return;

if (isset($_POST["tgl_upload_info"])) {
    $tgl_upload_info = $_POST["tgl_upload_info"];
} else
    return;

$query = "INSERT INTO `information` (`judul_info`, `kategori_info`, `isi_info`, `foto_info`, `tgl_upload_info`)
    VALUES ('$judul_info', '$kategori_info', '$isi_info', '$foto_info', '$tgl_upload_info')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>