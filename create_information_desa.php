<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["judul_infodes"])) {
    $judul_infodes = $_POST["judul_infodes"];
} else
    return;

if (isset($_POST["isi_infodes"])) {
    $isi_infodes = $_POST["isi_infodes"];
} else
    return;

if (isset($_POST["foto_infodes"])) {
    $foto_infodes = $_POST["foto_infodes"];
} else
    return;

if (isset($_POST["tgl_upload_infodes"])) {
    $tgl_upload_infodes = $_POST["tgl_upload_infodes"];
} else
    return;

$query = "INSERT INTO `information_desa` (`judul_infodes`, `isi_infodes`, `foto_infodes`, `tgl_upload_infodes`)
    VALUES ('$judul_infodes', '$isi_infodes', '$foto_infodes', '$tgl_upload_infodes')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>