<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_usaha"])) {
    $id_usaha = $_POST["id_usaha"];
} else
    return;

if (isset($_POST["us_konfirmasi"])) {
    $us_konfirmasi = $_POST["us_konfirmasi"];
} else
    return;

$query = "UPDATE `usaha` SET `us_konfirmasi`='$us_konfirmasi' WHERE `id_usaha`='$id_usaha'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>