<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

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

if (isset($_POST["tan_surat_konfirmasi"])) {
    $tan_surat_konfirmasi = $_POST["tan_surat_konfirmasi"];
} else
    return;

if (isset($_POST["tan_tgl_upload"])) {
    $tan_tgl_upload = $_POST["tan_tgl_upload"];
} else
    return;

if (isset($_POST["tan_konfirmasi"])) {
    $tan_konfirmasi = $_POST["tan_konfirmasi"];
} else
    return;

$query = "INSERT INTO `tanah` (`id_user`, `tan_judul`, `tan_foto_ktp`, `tan_foto_kk`, `tan_foto_sppt_shm`,
    `tan_surat_konfirmasi`, `tan_tgl_upload`, `tan_konfirmasi`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssss",
    $id_user,
    $tan_judul,
    $tan_foto_ktp,
    $tan_foto_kk,
    $tan_foto_sppt_shm,
    $tan_surat_konfirmasi,
    $tan_tgl_upload,
    $tan_konfirmasi
);

$arr = [];
if ($stmt->execute()) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

$stmt->close();
$con->close();

echo json_encode($arr);

?>