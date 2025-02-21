<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_akte"])) {
    $id_akte = $_POST["id_akte"];
} else
    return;

if (isset($_POST["ak_konfirmasi"])) {
    $ak_konfirmasi = $_POST["ak_konfirmasi"];
} else
    return;

$query = "UPDATE `akte` SET `ak_konfirmasi`='$ak_konfirmasi' WHERE `id_akte`='$id_akte'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>