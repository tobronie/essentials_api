<?php

include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["email"])) {
    $email = $_POST["email"];
} else
    return;

if (isset($_POST["password"])) {
    $password = $_POST["password"];
} else
    return;

$query = "SELECT * FROM `user` WHERE `email` = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$arr = [];

if ($row = mysqli_fetch_assoc($result)) {
    if ($password === $row["password"]) {
        $arr["success"] = "true";
        $arr["message"] = "Login berhasil";
        $arr["id_user"] = $row["id_user"];
        $arr["nama"] = $row["nama"];
        $arr["email"] = $row["email"];
    } else {
        $arr["message"] = "Password salah";
    }
} else {
    $arr["message"] = "Email tidak ditemukan";
}

echo json_encode($arr);

?>