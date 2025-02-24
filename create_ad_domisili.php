<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["dom_judul"])) {
    $dom_judul = $_POST["dom_judul"];
} else
    return;

if (isset($_POST["dom_foto_ktp"])) {
    $dom_foto_ktp = $_POST["dom_foto_ktp"];
} else
    return;

if (isset($_POST["dom_foto_kk"])) {
    $dom_foto_kk = $_POST["dom_foto_kk"];
} else
    return;

if (isset($_POST["dom_surat_konfirmasi"])) {
    $dom_surat_konfirmasi = $_POST["dom_surat_konfirmasi"];
} else
    return;

if (isset($_POST["dom_tgl_upload"])) {
    $dom_tgl_upload = $_POST["dom_tgl_upload"];
} else
    return;

if (isset($_POST["dom_konfirmasi"])) {
    $dom_konfirmasi = $_POST["dom_konfirmasi"];
} else
    return;

$query = "INSERT INTO `domisili` (`id_user`, `dom_judul`, `dom_foto_ktp`, `dom_foto_kk`, `dom_surat_konfirmasi`, `dom_tgl_upload`,
    `dom_konfirmasi`)
    VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "issssss",
    $id_user,
    $dom_judul,
    $dom_foto_ktp,
    $dom_foto_kk,
    $dom_surat_konfirmasi,
    $dom_tgl_upload,
    $dom_konfirmasi
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