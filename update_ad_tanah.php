<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_tanah"])) {
    $id_tanah = $_POST["id_tanah"];
} else
    return;

if (isset($_POST["tan_surat_konfirmasi"])) {
    $tan_surat_konfirmasi = $_POST["tan_surat_konfirmasi"];
} else
    return;

$query = "UPDATE `tanah` SET `tan_surat_konfirmasi`='$tan_surat_konfirmasi' WHERE `id_tanah`='$id_tanah'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>