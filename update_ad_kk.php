<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_kk"])) {
    $id_kk = $_POST["id_kk"];
} else
    return;

if (isset($_POST["kk_surat_konfirmasi"])) {
    $kk_surat_konfirmasi = $_POST["kk_surat_konfirmasi"];
} else
    return;

$query = "UPDATE `kk` SET `kk_surat_konfirmasi`='$kk_surat_konfirmasi' WHERE `id_kk`='$id_kk'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>