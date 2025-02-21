<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_lapor"])) {
    $id_lapor = $_POST["id_lapor"];
} else
    return;

if (isset($_POST["konfirmasi_lapor"])) {
    $konfirmasi_lapor = $_POST["konfirmasi_lapor"];
} else
    return;

$query = "UPDATE `pelaporan` SET `konfirmasi_lapor`='$konfirmasi_lapor' WHERE `id_lapor`='$id_lapor'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>