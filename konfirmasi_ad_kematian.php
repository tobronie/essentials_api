<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_kematian"])) {
    $id_kematian = $_POST["id_kematian"];
} else
    return;

if (isset($_POST["kem_konfirmasi"])) {
    $kem_konfirmasi = $_POST["kem_konfirmasi"];
} else
    return;

$query = "UPDATE `kematian` SET `kem_konfirmasi`='$kem_konfirmasi' WHERE `id_kematian`='$id_kematian'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>