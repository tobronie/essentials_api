<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["ak_judul"])) {
    $ak_judul = $_POST["ak_judul"];
} else
    return;

if (isset($_POST["ak_foto_surat_kelahiran"])) {
    $ak_foto_surat_kelahiran = $_POST["ak_foto_surat_kelahiran"];
} else
    return;

if (isset($_POST["ak_foto_kk"])) {
    $ak_foto_kk = $_POST["ak_foto_kk"];
} else
    return;

if (isset($_POST["ak_foto_ktp_ayah"])) {
    $ak_foto_ktp_ayah = $_POST["ak_foto_ktp_ayah"];
} else
    return;

if (isset($_POST["ak_foto_nikah_ayah"])) {
    $ak_foto_nikah_ayah = $_POST["ak_foto_nikah_ayah"];
} else
    return;

if (isset($_POST["ak_foto_ktp_ibu"])) {
    $ak_foto_ktp_ibu = $_POST["ak_foto_ktp_ibu"];
} else
    return;

if (isset($_POST["ak_foto_nikah_ibu"])) {
    $ak_foto_nikah_ibu = $_POST["ak_foto_nikah_ibu"];
} else
    return;

if (isset($_POST["ak_foto_ktp_saksi_satu"])) {
    $ak_foto_ktp_saksi_satu = $_POST["ak_foto_ktp_saksi_satu"];
} else
    return;

if (isset($_POST["ak_foto_ktp_saksi_dua"])) {
    $ak_foto_ktp_saksi_dua = $_POST["ak_foto_ktp_saksi_dua"];
} else
    return;

if (isset($_POST["ak_foto_ijasah_bersangkutan"])) {
    $ak_foto_ijasah_bersangkutan = $_POST["ak_foto_ijasah_bersangkutan"];
} else
    return;

if (isset($_POST["ak_foto_akte_saudara"])) {
    $ak_foto_akte_saudara = $_POST["ak_foto_akte_saudara"];
} else
    return;

if (isset($_POST["ak_surat_konfirmasi"])) {
    $ak_surat_konfirmasi = $_POST["ak_surat_konfirmasi"];
} else
    return;

if (isset($_POST["ak_tgl_upload"])) {
    $ak_tgl_upload = $_POST["ak_tgl_upload"];
} else
    return;

if (isset($_POST["ak_konfirmasi"])) {
    $ak_konfirmasi = $_POST["ak_konfirmasi"];
} else
    return;

$query = "INSERT INTO `akte` (`ak_judul`, `ak_foto_surat_kelahiran`, `ak_foto_kk`, `ak_foto_ktp_ayah`, `ak_foto_nikah_ayah`,
`ak_foto_ktp_ibu`,`ak_foto_nikah_ibu`, `ak_foto_ktp_saksi_satu`, `ak_foto_ktp_saksi_dua`, `ak_foto_ijasah_bersangkutan`,
`ak_foto_akte_saudara`, `ak_surat_konfirmasi`, `ak_tgl_upload`, `ak_konfirmasi`) VALUES ('$ak_judul', '$ak_foto_surat_kelahiran', '$ak_foto_kk', '$ak_foto_ktp_ayah',
'$ak_foto_nikah_ayah', '$ak_foto_ktp_ibu','$ak_foto_nikah_ibu', '$ak_foto_ktp_saksi_satu', '$ak_foto_ktp_saksi_dua',
'$ak_foto_ijasah_bersangkutan', '$ak_foto_akte_saudara', '$ak_surat_konfirmasi', '$ak_tgl_upload', '$ak_konfirmasi')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>