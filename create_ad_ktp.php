<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["kt_judul"])) {
    $kt_judul = $_POST["kt_judul"];
} else
    return;

if (isset($_POST["kt_foto_akte"])) {
    $kt_foto_akte = $_POST["kt_foto_akte"];
} else
    return;

if (isset($_POST["kt_foto_kk"])) {
    $kt_foto_kk = $_POST["kt_foto_kk"];
} else
    return;

if (isset($_POST["kt_foto_formulir"])) {
    $kt_foto_formulir = $_POST["kt_foto_formulir"];
} else
    return;

if (isset($_POST["kt_surat_konfirmasi"])) {
    $kt_surat_konfirmasi = $_POST["kt_surat_konfirmasi"];
} else
    return;

if (isset($_POST["kt_tgl_upload"])) {
    $kt_tgl_upload = $_POST["kt_tgl_upload"];
} else
    return;

if (isset($_POST["kt_konfirmasi"])) {
    $kt_konfirmasi = $_POST["kt_konfirmasi"];
} else
    return;

$query = "INSERT INTO `ktp` (`id_user`, `kt_judul`, `kt_foto_akte`, `kt_foto_kk`, `kt_foto_formulir`, `kt_surat_konfirmasi`,
`kt_tgl_upload`, `kt_konfirmasi`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssss",
    $id_user,
    $kt_judul,
    $kt_foto_akte,
    $kt_foto_kk,
    $kt_foto_formulir,
    $kt_surat_konfirmasi,
    $kt_tgl_upload,
    $kt_konfirmasi
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