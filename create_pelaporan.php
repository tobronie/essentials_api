<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["judul_lapor"])) {
    $judul_lapor = $_POST["judul_lapor"];
} else
    return;

if (isset($_POST["waktu_lapor"])) {
    $waktu_lapor = $_POST["waktu_lapor"];
} else
    return;

if (isset($_POST["lokasi_lapor"])) {
    $lokasi_lapor = $_POST["lokasi_lapor"];
} else
    return;

if (isset($_POST["isi_lapor"])) {
    $isi_lapor = $_POST["isi_lapor"];
} else
    return;

if (isset($_POST["foto_lapor"])) {
    $foto_lapor = $_POST["foto_lapor"];
} else
    return;

if (isset($_POST["tgl_upload_lapor"])) {
    $tgl_upload_lapor = $_POST["tgl_upload_lapor"];
} else
    return;

if (isset($_POST["konfirmasi_lapor"])) {
    $konfirmasi_lapor = $_POST["konfirmasi_lapor"];
} else
    return;

$query = "INSERT INTO `pelaporan` (`id_user`, `judul_lapor`, `waktu_lapor`, `lokasi_lapor`, `isi_lapor`, `foto_lapor`,
    `tgl_upload_lapor`, `konfirmasi_lapor`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssss",
    $id_user,
    $judul_lapor,
    $waktu_lapor,
    $lokasi_lapor,
    $isi_lapor,
    $foto_lapor,
    $tgl_upload_lapor,
    $konfirmasi_lapor
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