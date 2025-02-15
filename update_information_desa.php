<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_infodes"])) {
    $id_infodes = $_POST["id_infodes"];
} else
    return;

if (isset($_POST["judul_infodes"])) {
    $judul_infodes = $_POST["judul_infodes"];
} else
    return;

if (isset($_POST["isi_infodes"])) {
    $isi_infodes = $_POST["isi_infodes"];
} else
    return;

if (isset($_POST["tgl_upload_infodes"])) {
    $tgl_upload_infodes = $_POST["tgl_upload_infodes"];
} else
    return;

$query = "UPDATE `information_desa` SET `judul_infodes`='$judul_infodes', `isi_infodes`='$isi_infodes',
`tgl_upload_infodes`='$tgl_upload_infodes' WHERE `id_infodes`='$id_infodes'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>