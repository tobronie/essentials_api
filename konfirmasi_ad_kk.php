<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_kk"])) {
    $id_kk = $_POST["id_kk"];
} else
    return;

if (isset($_POST["kk_konfirmasi"])) {
    $kk_konfirmasi = $_POST["kk_konfirmasi"];
} else
    return;

$query = "UPDATE `kk` SET `kk_konfirmasi`='$kk_konfirmasi' WHERE `id_kk`='$id_kk'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>