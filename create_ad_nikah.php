<?php

include("db_koneksi.php");
$con = db_koneksi();

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

if (isset($_POST["ni_tgl_upload"])) {
    $ni_tgl_upload = $_POST["ni_tgl_upload"];
} else
    return;

$query = "INSERT INTO `nikah` (`ni_judul`, `ni_foto_ktp_pria`, `ni_foto_kk_pria`, `ni_foto_akte_pria`, `ni_foto_formulir_pria`,
`ni_foto_nikah_ayah_pria`, `ni_foto_nikah_ibu_pria`, `ni_foto_ktp_wanita`, `ni_foto_kk_wanita`, `ni_foto_akte_wanita`,
`ni_foto_formulir_wanita`, `ni_foto_nikah_ayah_wanita`, `ni_foto_nikah_ibu_wanita`, `ni_tgl_upload`) VALUES ('$ni_judul',
'$ni_foto_ktp_pria', '$ni_foto_kk_pria', '$ni_foto_akte_pria', '$ni_foto_formulir_pria', '$ni_foto_nikah_ayah_pria',
'$ni_foto_nikah_ibu_pria', '$ni_foto_ktp_wanita', '$ni_foto_kk_wanita', '$ni_foto_akte_wanita', '$ni_foto_formulir_wanita',
'$ni_foto_nikah_ayah_wanita','$ni_foto_nikah_ibu_wanita', '$ni_tgl_upload')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>