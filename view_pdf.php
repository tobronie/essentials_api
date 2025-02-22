<?php
include("db_koneksi.php");
$con = db_koneksi();

if (!isset($_GET["id_akte"])) {
    echo "ID Akte tidak ditemukan";
    exit;
}

$id_akte = $_GET["id_akte"];
$query = "SELECT ak_surat_konfirmasi FROM akte WHERE id_akte = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id_akte);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $file_path);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if (!$file_path || !file_exists($file_path)) {
    echo "File tidak ditemukan";
    exit;
}

header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename='document.pdf'");
readfile($file_path);
?>
