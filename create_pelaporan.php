<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["judul_lapor"])) {
    $judul_lapor = $_POST["judul_lapor"];
} else
    return;

if (isset($_POST["waktu_lapor"])) {
    $waktu_lapor = $_POST["waktu_lapor"];
} else
    return;

if (isset($_POST["lokasi_lapor"])) {
    $lokasi_lapor = $_POST["lokasi_lapor"];
} else
    return;

if (isset($_POST["isi_lapor"])) {
    $isi_lapor = $_POST["isi_lapor"];
} else
    return;

if (isset($_POST["foto_lapor"])) {
    $foto_lapor = $_POST["foto_lapor"];
} else
    return;

if (isset($_POST["tgl_upload_lapor"])) {
    $tgl_upload_lapor = $_POST["tgl_upload_lapor"];
} else
    return;

$query = "INSERT INTO `pelaporan` (`judul_lapor`, `waktu_lapor`, `lokasi_lapor`, `isi_lapor`, `foto_lapor`, `tgl_upload_lapor`)
    VALUES ('$judul_lapor', '$waktu_lapor', '$lokasi_lapor', '$isi_lapor', '$foto_lapor', '$tgl_upload_lapor')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>