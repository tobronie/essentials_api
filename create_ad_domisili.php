<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["dom_judul"])) {
    $dom_judul = $_POST["dom_judul"];
} else
    return;

if (isset($_POST["dom_foto_ktp"])) {
    $dom_foto_ktp = $_POST["dom_foto_ktp"];
} else
    return;

if (isset($_POST["dom_foto_kk"])) {
    $dom_foto_kk = $_POST["dom_foto_kk"];
} else
    return;

if (isset($_POST["dom_tgl_upload"])) {
    $dom_tgl_upload = $_POST["dom_tgl_upload"];
} else
    return;

$query = "INSERT INTO `domisili` (`dom_judul`, `dom_foto_ktp`, `dom_foto_kk`, `dom_tgl_upload`)
    VALUES ('$dom_judul', '$dom_foto_ktp', '$dom_foto_kk', '$dom_tgl_upload')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>