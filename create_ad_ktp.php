<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["kt_judul"])) {
    $kt_judul = $_POST["kt_judul"];
} else
    return;

if (isset($_POST["kt_foto_akte"])) {
    $kt_foto_akte = $_POST["kt_foto_akte"];
} else
    return;

if (isset($_POST["kt_foto_kk"])) {
    $kt_foto_kk = $_POST["kt_foto_kk"];
} else
    return;

if (isset($_POST["kt_foto_formulir"])) {
    $kt_foto_formulir = $_POST["kt_foto_formulir"];
} else
    return;

if (isset($_POST["kt_tgl_upload"])) {
    $kt_tgl_upload = $_POST["kt_tgl_upload"];
} else
    return;

$query = "INSERT INTO `ktp` (`kt_judul`, `kt_foto_akte`, `kt_foto_kk`, `kt_foto_formulir`, `kt_tgl_upload`) VALUES
('$kt_judul', '$kt_foto_akte', '$kt_foto_kk', '$kt_foto_formulir', '$kt_tgl_upload')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>