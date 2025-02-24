<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["kem_judul"])) {
    $kem_judul = $_POST["kem_judul"];
} else
    return;

if (isset($_POST["kem_nama_almarhum"])) {
    $kem_nama_almarhum = $_POST["kem_nama_almarhum"];
} else
    return;

if (isset($_POST["kem_foto_ktp_almarhum"])) {
    $kem_foto_ktp_almarhum = $_POST["kem_foto_ktp_almarhum"];
} else
    return;

if (isset($_POST["kem_foto_kk"])) {
    $kem_foto_kk = $_POST["kem_foto_kk"];
} else
    return;

if (isset($_POST["kem_foto_surat_kematian"])) {
    $kem_foto_surat_kematian = $_POST["kem_foto_surat_kematian"];
} else
    return;

if (isset($_POST["kem_foto_ktp_saksi"])) {
    $kem_foto_ktp_saksi = $_POST["kem_foto_ktp_saksi"];
} else
    return;

if (isset($_POST["kem_surat_konfirmasi"])) {
    $kem_surat_konfirmasi = $_POST["kem_surat_konfirmasi"];
} else
    return;

if (isset($_POST["kem_tgl_upload"])) {
    $kem_tgl_upload = $_POST["kem_tgl_upload"];
} else
    return;

if (isset($_POST["kem_konfirmasi"])) {
    $kem_konfirmasi = $_POST["kem_konfirmasi"];
} else
    return;

$query = "INSERT INTO `kematian` (`id_user`, `kem_judul`, `kem_nama_almarhum`, `kem_foto_ktp_almarhum`, `kem_foto_kk`,
`kem_foto_surat_kematian`, `kem_foto_ktp_saksi`, `kem_surat_konfirmasi`, `kem_tgl_upload`, `kem_konfirmasi`)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssssss",
    $id_user,
    $kem_judul,
    $kem_nama_almarhum,
    $kem_foto_ktp_almarhum,
    $kem_foto_kk,
    $kem_foto_surat_kematian,
    $kem_foto_ktp_saksi,
    $kem_surat_konfirmasi,
    $kem_tgl_upload,
    $kem_konfirmasi
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