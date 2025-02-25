<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["kk"])) {
    $kk = $_POST["kk"];
} else
    return;

if (isset($_POST["dusun"])) {
    $dusun = $_POST["dusun"];
} else
    return;

if (isset($_POST["rt"])) {
    $rt = $_POST["rt"];
} else
    return;

if (isset($_POST["rw"])) {
    $rw = $_POST["rw"];
} else
    return;

if (isset($_POST["pekerjaan"])) {
    $pekerjaan = $_POST["pekerjaan"];
} else
    return;

$query = "UPDATE `user` SET `kk`='$kk', `dusun`='$dusun', `rt`='$rt',
`rw`='$rw', `pekerjaan`='$pekerjaan' WHERE `id_user`='$id_user'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>