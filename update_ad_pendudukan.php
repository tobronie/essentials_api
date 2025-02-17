<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_pendudukan"])) {
    $id_pendudukan = $_POST["id_pendudukan"];
} else
    return;

if (isset($_POST["pen_surat_konfirmasi"])) {
    $pen_surat_konfirmasi = $_POST["pen_surat_konfirmasi"];
} else
    return;

$query = "UPDATE `pendudukan` SET `pen_surat_konfirmasi`='$pen_surat_konfirmasi' WHERE `id_pendudukan`='$id_pendudukan'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>