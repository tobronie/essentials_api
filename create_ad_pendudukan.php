<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["pen_judul"])) {
    $pen_judul = $_POST["pen_judul"];
} else
    return;

if (isset($_POST["pen_foto_ktp"])) {
    $pen_foto_ktp = $_POST["pen_foto_ktp"];
} else
    return;

if (isset($_POST["pen_foto_kk"])) {
    $pen_foto_kk = $_POST["pen_foto_kk"];
} else
    return;

if (isset($_POST["pen_foto_nikah_pria"])) {
    $pen_foto_nikah_pria = $_POST["pen_foto_nikah_pria"];
} else
    return;

if (isset($_POST["pen_foto_nikah_wanita"])) {
    $pen_foto_nikah_wanita = $_POST["pen_foto_nikah_wanita"];
} else
    return;

if (isset($_POST["pen_daerah_asal"])) {
    $pen_daerah_asal = $_POST["pen_daerah_asal"];
} else
    return;

if (isset($_POST["pen_daerah_tujuan"])) {
    $pen_daerah_tujuan = $_POST["pen_daerah_tujuan"];
} else
    return;

if (isset($_POST["pen_surat_konfirmasi"])) {
    $pen_surat_konfirmasi = $_POST["pen_surat_konfirmasi"];
} else
    return;

if (isset($_POST["pen_tgl_upload"])) {
    $pen_tgl_upload = $_POST["pen_tgl_upload"];
} else
    return;

if (isset($_POST["pen_konfirmasi"])) {
    $pen_konfirmasi = $_POST["pen_konfirmasi"];
} else
    return;

$query = "INSERT INTO `pendudukan` (`id_user`,`pen_judul`, `pen_foto_ktp`, `pen_foto_kk`, `pen_foto_nikah_pria`,
    `pen_foto_nikah_wanita`, `pen_daerah_asal`, `pen_daerah_tujuan`, `pen_surat_konfirmasi`, `pen_tgl_upload`,
    `pen_konfirmasi`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "issssssssss",
    $id_user,
    $pen_judul,
    $pen_foto_ktp,
    $pen_foto_kk,
    $pen_foto_nikah_pria,
    $pen_foto_nikah_wanita,
    $pen_daerah_asal,
    $pen_daerah_tujuan,
    $pen_surat_konfirmasi,
    $pen_tgl_upload,
    $pen_konfirmasi
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