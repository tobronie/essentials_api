<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["ni_judul"])) {
    $ni_judul = $_POST["ni_judul"];
} else
    return;

if (isset($_POST["ni_foto_ktp_pria"])) {
    $ni_foto_ktp_pria = $_POST["ni_foto_ktp_pria"];
} else
    return;

if (isset($_POST["ni_foto_kk_pria"])) {
    $ni_foto_kk_pria = $_POST["ni_foto_kk_pria"];
} else
    return;

if (isset($_POST["ni_foto_akte_pria"])) {
    $ni_foto_akte_pria = $_POST["ni_foto_akte_pria"];
} else
    return;

if (isset($_POST["ni_foto_formulir_pria"])) {
    $ni_foto_formulir_pria = $_POST["ni_foto_formulir_pria"];
} else
    return;

if (isset($_POST["ni_foto_nikah_ayah_pria"])) {
    $ni_foto_nikah_ayah_pria = $_POST["ni_foto_nikah_ayah_pria"];
} else
    return;

if (isset($_POST["ni_foto_nikah_ibu_pria"])) {
    $ni_foto_nikah_ibu_pria = $_POST["ni_foto_nikah_ibu_pria"];
} else
    return;

if (isset($_POST["ni_foto_ktp_wanita"])) {
    $ni_foto_ktp_wanita = $_POST["ni_foto_ktp_wanita"];
} else
    return;

if (isset($_POST["ni_foto_kk_wanita"])) {
    $ni_foto_kk_wanita = $_POST["ni_foto_kk_wanita"];
} else
    return;

if (isset($_POST["ni_foto_akte_wanita"])) {
    $ni_foto_akte_wanita = $_POST["ni_foto_akte_wanita"];
} else
    return;

if (isset($_POST["ni_foto_formulir_wanita"])) {
    $ni_foto_formulir_wanita = $_POST["ni_foto_formulir_wanita"];
} else
    return;

if (isset($_POST["ni_foto_nikah_ayah_wanita"])) {
    $ni_foto_nikah_ayah_wanita = $_POST["ni_foto_nikah_ayah_wanita"];
} else
    return;

if (isset($_POST["ni_foto_nikah_ibu_wanita"])) {
    $ni_foto_nikah_ibu_wanita = $_POST["ni_foto_nikah_ibu_wanita"];
} else
    return;

if (isset($_POST["ni_surat_konfirmasi"])) {
    $ni_surat_konfirmasi = $_POST["ni_surat_konfirmasi"];
} else
    return;

if (isset($_POST["ni_tgl_upload"])) {
    $ni_tgl_upload = $_POST["ni_tgl_upload"];
} else
    return;

if (isset($_POST["ni_konfirmasi"])) {
    $ni_konfirmasi = $_POST["ni_konfirmasi"];
} else
    return;

$query = "INSERT INTO `nikah` (`id_user`, `ni_judul`, `ni_foto_ktp_pria`, `ni_foto_kk_pria`, `ni_foto_akte_pria`, `ni_foto_formulir_pria`,
    `ni_foto_nikah_ayah_pria`, `ni_foto_nikah_ibu_pria`, `ni_foto_ktp_wanita`, `ni_foto_kk_wanita`, `ni_foto_akte_wanita`,
    `ni_foto_formulir_wanita`, `ni_foto_nikah_ayah_wanita`, `ni_foto_nikah_ibu_wanita`, `ni_surat_konfirmasi`, `ni_tgl_upload`, `ni_konfirmasi`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "issssssssssssssss",
    $id_user,
    $ni_judul,
    $ni_foto_ktp_pria,
    $ni_foto_kk_pria,
    $ni_foto_akte_pria,
    $ni_foto_formulir_pria,
    $ni_foto_nikah_ayah_pria,
    $ni_foto_nikah_ibu_pria,
    $ni_foto_ktp_wanita,
    $ni_foto_kk_wanita,
    $ni_foto_akte_wanita,
    $ni_foto_formulir_wanita,
    $ni_foto_nikah_ayah_wanita,
    $ni_foto_nikah_ibu_wanita,
    $ni_surat_konfirmasi,
    $ni_tgl_upload,
    $ni_konfirmasi
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