<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_sktm"])) {
    $id_sktm = $_POST["id_sktm"];
} else
    return;

if (isset($_POST["sktm_konfirmasi"])) {
    $sktm_konfirmasi = $_POST["sktm_konfirmasi"];
} else
    return;

$query = "UPDATE `sktm` SET `sktm_konfirmasi`='$sktm_konfirmasi' WHERE `id_sktm`='$id_sktm'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>