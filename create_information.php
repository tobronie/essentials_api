<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_POST["judul_info"], $_POST["kategori_info"], $_POST["isi_info"], $_POST["tgl_upload_info"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}
$judul_info = mysqli_real_escape_string($con, $_POST["judul_info"]);
$kategori_info = mysqli_real_escape_string($con, $_POST["kategori_info"]);
$isi_info = mysqli_real_escape_string($con, $_POST["isi_info"]);
$tgl_upload_info = mysqli_real_escape_string($con, $_POST["tgl_upload_info"]);

$foto_info = null;
if (isset($_FILES["foto_info"]) && $_FILES["foto_info"]["error"] == UPLOAD_ERR_OK) {
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_tmp = $_FILES["foto_info"]["tmp_name"];
    $file_name = time() . "_" . basename($_FILES["foto_info"]["name"]);
    $file_path = $upload_dir . $file_name;
    if (move_uploaded_file($file_tmp, $file_path)) {
        $foto_info = $file_name;
    } else {
        echo json_encode(["success" => "false", "message" => "Gagal mengunggah gambar"]);
        exit;
    }
}
$query = "INSERT INTO `information` (`judul_info`, `kategori_info`, `isi_info`, `foto_info`, `tgl_upload_info`) 
          VALUES ('$judul_info', '$kategori_info', '$isi_info', '$foto_info', '$tgl_upload_info')";

$exe = mysqli_query($con, $query);

if ($exe) {
    echo json_encode(["success" => "true", "message" => "Data berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . mysqli_error($con)]);
}
?>