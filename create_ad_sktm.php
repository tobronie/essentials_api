<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["sktm_judul"])) {
    $sktm_judul = $_POST["sktm_judul"];
} else
    return;

if (isset($_POST["sktm_nama_wali"])) {
    $sktm_nama_wali = $_POST["sktm_nama_wali"];
} else
    return;

if (isset($_POST["sktm_nominal"])) {
    $sktm_nominal = $_POST["sktm_nominal"];
} else
    return;

if (isset($_POST["sktm_rincian"])) {
    $sktm_rincian = $_POST["sktm_rincian"];
} else
    return;

if (isset($_POST["sktm_foto_ktp"])) {
    $sktm_foto_ktp = $_POST["sktm_foto_ktp"];
} else
    return;

if (isset($_POST["sktm_foto_kk"])) {
    $sktm_foto_kk = $_POST["sktm_foto_kk"];
} else
    return;

if (isset($_POST["sktm_surat_konfirmasi"])) {
    $sktm_surat_konfirmasi = $_POST["sktm_surat_konfirmasi"];
} else
    return;

if (isset($_POST["sktm_tgl_upload"])) {
    $sktm_tgl_upload = $_POST["sktm_tgl_upload"];
} else
    return;

if (isset($_POST["sktm_konfirmasi"])) {
    $sktm_konfirmasi = $_POST["sktm_konfirmasi"];
} else
    return;

$query = "INSERT INTO `sktm` (`id_user`, `sktm_judul`, `sktm_nama_wali`, `sktm_nominal`, `sktm_rincian`, `sktm_foto_ktp`,
    `sktm_foto_kk`, `sktm_surat_konfirmasi`, `sktm_tgl_upload`, `sktm_konfirmasi`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssssss",
    $id_user,
    $sktm_judul,
    $sktm_nama_wali,
    $sktm_nominal,
    $sktm_rincian,
    $sktm_foto_ktp,
    $sktm_foto_kk,
    $sktm_surat_konfirmasi,
    $sktm_tgl_upload,
    $sktm_konfirmasi
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