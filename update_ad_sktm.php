<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_sktm"])) {
    $id_sktm = $_POST["id_sktm"];
} else
    return;

if (isset($_POST["sktm_surat_konfirmasi"])) {
    $sktm_surat_konfirmasi = $_POST["sktm_surat_konfirmasi"];
} else
    return;

$query = "UPDATE `sktm` SET `sktm_surat_konfirmasi`='$sktm_surat_konfirmasi' WHERE `id_sktm`='$id_sktm'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>