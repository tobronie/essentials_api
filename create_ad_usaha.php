<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

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

if (isset($_POST["us_surat_konfirmasi"])) {
    $us_surat_konfirmasi = $_POST["us_surat_konfirmasi"];
} else
    return;

if (isset($_POST["us_konfirmasi"])) {
    $us_konfirmasi = $_POST["us_konfirmasi"];
} else
    return;

$query = "INSERT INTO `usaha` (`id_user`, `us_judul`, `us_foto_ktp`, `us_foto_kk`, `us_omset`, `us_surat_konfirmasi`,
    `us_tgl_upload`, `us_konfirmasi`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssss",
    $id_user,
    $us_judul,
    $us_foto_ktp,
    $us_foto_kk,
    $us_omset,
    $us_surat_konfirmasi,
    $us_tgl_upload,
    $us_konfirmasi
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