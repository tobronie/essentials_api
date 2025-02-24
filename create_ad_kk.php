<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["kk_judul"])) {
    $kk_judul = $_POST["kk_judul"];
} else
    return;

if (isset($_POST["kk_foto_kk"])) {
    $kk_foto_kk = $_POST["kk_foto_kk"];
} else
    return;

if (isset($_POST["kk_foto_nikah_ayah"])) {
    $kk_foto_nikah_ayah = $_POST["kk_foto_nikah_ayah"];
} else
    return;

if (isset($_POST["kk_foto_nikah_ibu"])) {
    $kk_foto_nikah_ibu = $_POST["kk_foto_nikah_ibu"];
} else
    return;

if (isset($_POST["kk_foto_ijasah_keluarga"])) {
    $kk_foto_ijasah_keluarga = $_POST["kk_foto_ijasah_keluarga"];
} else
    return;

if (isset($_POST["kk_foto_akte_keluarga"])) {
    $kk_foto_akte_keluarga = $_POST["kk_foto_akte_keluarga"];
} else
    return;

if (isset($_POST["kk_surat_konfirmasi"])) {
    $kk_surat_konfirmasi = $_POST["kk_surat_konfirmasi"];
} else
    return;

if (isset($_POST["kk_tgl_upload"])) {
    $kk_tgl_upload = $_POST["kk_tgl_upload"];
} else
    return;

if (isset($_POST["kk_konfirmasi"])) {
    $kk_konfirmasi = $_POST["kk_konfirmasi"];
} else
    return;

$query = "INSERT INTO `kk` (`id_user`, `kk_judul`, `kk_foto_kk`, `kk_foto_nikah_ayah`, `kk_foto_nikah_ibu`, `kk_foto_ijasah_keluarga`, 
`kk_foto_akte_keluarga`, `kk_surat_konfirmasi`, `kk_tgl_upload`, `kk_konfirmasi`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssssss",
    $id_user,
    $kk_judul,
    $kk_foto_kk,
    $kk_foto_nikah_ayah,
    $kk_foto_nikah_ibu,
    $kk_foto_ijasah_keluarga,
    $kk_foto_akte_keluarga,
    $kk_surat_konfirmasi,
    $kk_tgl_upload,
    $kk_konfirmasi
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