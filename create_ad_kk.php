<?php

include("db_koneksi.php");
$con = db_koneksi();

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

if (isset($_POST["kk_tgl_upload"])) {
    $kk_tgl_upload = $_POST["kk_tgl_upload"];
} else
    return;

$query = "INSERT INTO `kk` (`kk_judul`, `kk_foto_kk`, `kk_foto_nikah_ayah`, `kk_foto_nikah_ibu`, `kk_foto_ijasah_keluarga`, 
`kk_foto_akte_keluarga`, `kk_tgl_upload`) VALUES ('$kk_judul', '$kk_foto_kk', '$kk_foto_nikah_ayah', '$kk_foto_nikah_ibu',
'$kk_foto_ijasah_keluarga', '$kk_foto_akte_keluarga', '$kk_tgl_upload')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>