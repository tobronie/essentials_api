<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_domisili"])) {
    $id_domisili = $_POST["id_domisili"];
} else
    return;

if (isset($_POST["dom_surat_konfirmasi"])) {
    $dom_surat_konfirmasi = $_POST["dom_surat_konfirmasi"];
} else
    return;

$query = "UPDATE `domisili` SET `dom_surat_konfirmasi`='$dom_surat_konfirmasi' WHERE `id_domisili`='$id_domisili'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>