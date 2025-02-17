<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_ktp"])) {
    $id_ktp = $_POST["id_ktp"];
} else
    return;

if (isset($_POST["kt_surat_konfirmasi"])) {
    $kt_surat_konfirmasi = $_POST["kt_surat_konfirmasi"];
} else
    return;

$query = "UPDATE `ktp` SET `kt_surat_konfirmasi`='$kt_surat_konfirmasi' WHERE `id_ktp`='$id_ktp'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>