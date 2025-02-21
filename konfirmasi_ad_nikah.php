<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_nikah"])) {
    $id_nikah = $_POST["id_nikah"];
} else
    return;

if (isset($_POST["ni_konfirmasi"])) {
    $ni_konfirmasi = $_POST["ni_konfirmasi"];
} else
    return;

$query = "UPDATE `nikah` SET `ni_konfirmasi`='$ni_konfirmasi' WHERE `id_nikah`='$id_nikah'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>