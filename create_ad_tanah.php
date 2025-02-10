<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["tan_judul"])) {
    $tan_judul = $_POST["tan_judul"];
} else
    return;

if (isset($_POST["tan_foto_ktp"])) {
    $tan_foto_ktp = $_POST["tan_foto_ktp"];
} else
    return;

if (isset($_POST["tan_foto_kk"])) {
    $tan_foto_kk = $_POST["tan_foto_kk"];
} else
    return;

if (isset($_POST["tan_foto_sppt_shm"])) {
    $tan_foto_sppt_shm = $_POST["tan_foto_sppt_shm"];
} else
    return;

if (isset($_POST["tan_tgl_upload"])) {
    $tan_tgl_upload = $_POST["tan_tgl_upload"];
} else
    return;

$query = "INSERT INTO `tanah` (`tan_judul`, `tan_foto_ktp`, `tan_foto_kk`, `tan_foto_sppt_shm`, `tan_tgl_upload`)
    VALUES ('$tan_judul', '$tan_foto_ktp', '$tan_foto_kk', '$tan_foto_sppt_shm', '$tan_tgl_upload')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>