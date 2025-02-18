<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["us_judul"])) {
    $us_judul = $_POST["us_judul"];
} else
    return;

if (isset($_POST["us_foto_ktp"])) {
    $us_foto_ktp = $_POST["us_foto_ktp"];
} else
    return;

if (isset($_POST["us_foto_kk"])) {
    $us_foto_kk = $_POST["us_foto_kk"];
} else
    return;

if (isset($_POST["us_omset"])) {
    $us_omset = $_POST["us_omset"];
} else
    return;

if (isset($_POST["us_tgl_upload"])) {
    $us_tgl_upload = $_POST["us_tgl_upload"];
} else
    return;

if (isset($_POST["us_konfirmasi"])) {
    $us_konfirmasi = $_POST["us_konfirmasi"];
} else
    return;

$query = "INSERT INTO `usaha` (`us_judul`, `us_foto_ktp`, `us_foto_kk`, `us_omset`, `us_tgl_upload`, `us_konfirmasi`)
    VALUES ('$us_judul', '$us_foto_ktp', '$us_foto_kk', '$us_omset', '$us_tgl_upload', '$us_konfirmasi')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>