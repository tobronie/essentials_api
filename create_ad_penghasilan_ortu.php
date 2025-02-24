<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["has_judul"])) {
    $has_judul = $_POST["has_judul"];
} else
    return;

if (isset($_POST["has_pekerjaan_ayah"])) {
    $has_pekerjaan_ayah = $_POST["has_pekerjaan_ayah"];
} else
    return;

if (isset($_POST["has_pendapatan_ayah"])) {
    $has_pendapatan_ayah = $_POST["has_pendapatan_ayah"];
} else
    return;

if (isset($_POST["has_pekerjaan_ibu"])) {
    $has_pekerjaan_ibu = $_POST["has_pekerjaan_ibu"];
} else
    return;

if (isset($_POST["has_pendapatan_ibu"])) {
    $has_pendapatan_ibu = $_POST["has_pendapatan_ibu"];
} else
    return;

if (isset($_POST["has_foto_ktp"])) {
    $has_foto_ktp = $_POST["has_foto_ktp"];
} else
    return;

if (isset($_POST["has_foto_kk"])) {
    $has_foto_kk = $_POST["has_foto_kk"];
} else
    return;

if (isset($_POST["has_foto_pendukung_ayah"])) {
    $has_foto_pendukung_ayah = $_POST["has_foto_pendukung_ayah"];
} else
    return;

if (isset($_POST["has_foto_pendukung_ibu"])) {
    $has_foto_pendukung_ibu = $_POST["has_foto_pendukung_ibu"];
} else
    return;

if (isset($_POST["has_surat_konfirmasi"])) {
    $has_surat_konfirmasi = $_POST["has_surat_konfirmasi"];
} else
    return;

if (isset($_POST["has_tgl_upload"])) {
    $has_tgl_upload = $_POST["has_tgl_upload"];
} else
    return;

if (isset($_POST["has_konfirmasi"])) {
    $has_konfirmasi = $_POST["has_konfirmasi"];
} else
    return;

$query = "INSERT INTO `penghasilan_ortu` (`id_user`, `has_judul`, `has_pekerjaan_ayah`, `has_pendapatan_ayah`,
    `has_pekerjaan_ibu`, `has_pendapatan_ibu`, `has_foto_ktp`, `has_foto_kk`, `has_foto_pendukung_ayah`,
    `has_foto_pendukung_ibu`, `has_surat_konfirmasi`, `has_tgl_upload`, `has_konfirmasi`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "issssssssssss",
    $id_user,
    $has_judul,
    $has_pekerjaan_ayah,
    $has_pendapatan_ayah,
    $has_pekerjaan_ibu,
    $has_pendapatan_ibu,
    $has_foto_ktp,
    $has_foto_kk,
    $has_foto_pendukung_ayah,
    $has_foto_pendukung_ibu,
    $has_surat_konfirmasi,
    $has_tgl_upload,
    $has_konfirmasi
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