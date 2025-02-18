<?php

include("db_koneksi.php");
$con = db_koneksi();

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

if (isset($_POST["has_tgl_upload"])) {
    $has_tgl_upload = $_POST["has_tgl_upload"];
} else
    return;

if (isset($_POST["has_konfirmasi"])) {
    $has_konfirmasi = $_POST["has_konfirmasi"];
} else
    return;

$query = "INSERT INTO `penghasilan_ortu` (`has_judul`, `has_pekerjaan_ayah`, `has_pendapatan_ayah`, `has_pekerjaan_ibu`,
`has_pendapatan_ibu`, `has_foto_ktp`, `has_foto_kk`, `has_foto_pendukung_ayah`, `has_foto_pendukung_ibu`, `has_tgl_upload`, `has_konfirmasi`)
VALUES ('$has_judul', '$has_pekerjaan_ayah', '$has_pendapatan_ayah', '$has_pekerjaan_ibu', '$has_pendapatan_ibu', '$has_foto_ktp',
'$has_foto_kk', '$has_foto_pendukung_ayah', '$has_foto_pendukung_ibu', '$has_tgl_upload', '$has_konfirmasi')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>