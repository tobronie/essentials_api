<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["nama"])) {
    $nama = $_POST["nama"];
} else
    return;

if (isset($_POST["nik"])) {
    $nik = $_POST["nik"];
} else
    return;

if (isset($_POST["no_hp"])) {
    $no_hp = $_POST["no_hp"];
} else
    return;

if (isset($_POST["email"])) {
    $email = $_POST["email"];
} else
    return; 

if (isset($_POST["password"])) {
    $password = $_POST["password"];
} else
    return;

// Pengecekan NIK
$cekNikQuery = "SELECT * FROM `user` WHERE `nik` = ?";
$cekNikStmt = mysqli_prepare($con, $cekNikQuery);
mysqli_stmt_bind_param($cekNikStmt, "s", $nik);
mysqli_stmt_execute($cekNikStmt);
$result = mysqli_stmt_get_result($cekNikStmt);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(["status" => "error", "message" => "NIK sudah terdaftar"]);
    exit();
}

// Pengecekan No Handphone
$cekNoQuery = "SELECT * FROM `user` WHERE `no_hp` = ?";
$cekNoStmt = mysqli_prepare($con, $cekNoQuery);
mysqli_stmt_bind_param($cekNoStmt, "s", $no_hp);
mysqli_stmt_execute($cekNoStmt);
$result = mysqli_stmt_get_result($cekNoStmt);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(["status" => "error", "message" => "No Handphone sudah terdaftar"]);
    exit();
}

// Pengecekan Email
$cekEmailQuery = "SELECT * FROM `user` WHERE `email` = ?";
$cekEmailStmt = mysqli_prepare($con, $cekEmailQuery);
mysqli_stmt_bind_param($cekEmailStmt, "s", $email);
mysqli_stmt_execute($cekEmailStmt);
$result = mysqli_stmt_get_result($cekEmailStmt);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(["status" => "error", "message" => "Email sudah terdaftar"]);
    exit();
}

$query = "INSERT INTO `user` (`nama`, `nik`, `no_hp`, `email`, `password`)
VALUES ('$nama', '$nik', '$no_hp', '$email', '$password')";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>