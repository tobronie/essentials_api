<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_penghasilan"])) {
    $id_penghasilan = $_POST["id_penghasilan"];
} else
    return;

if (isset($_POST["has_konfirmasi"])) {
    $has_konfirmasi = $_POST["has_konfirmasi"];
} else
    return;

$query = "UPDATE `penghasilan_ortu` SET `has_konfirmasi`='$has_konfirmasi' WHERE `id_penghasilan`='$id_penghasilan'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>