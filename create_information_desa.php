<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["judul_infodes"], $_POST["isi_infodes"], $_POST["tgl_upload_infodes"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$judul_infodes = mysqli_real_escape_string($con, $_POST["judul_infodes"]);
$isi_infodes = mysqli_real_escape_string($con, $_POST["isi_infodes"]);
$tgl_upload_infodes = mysqli_real_escape_string($con, $_POST["tgl_upload_infodes"]);

$foto_infodes = null;
if (isset($_FILES["foto_infodes"]) && $_FILES["foto_infodes"]["error"] == UPLOAD_ERR_OK) {
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_tmp = $_FILES["foto_infodes"]["tmp_name"];
    $file_name = time() . "_" . basename($_FILES["foto_infodes"]["name"]);
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($file_tmp, $file_path)) {
        $foto_infodes = $file_name;
    } else {
        echo json_encode(["success" => "false", "message" => "Gagal mengunggah gambar"]);
        exit;
    }
}

$query = "INSERT INTO `information_desa` (`judul_infodes`, `isi_infodes`, `foto_infodes`, `tgl_upload_infodes`) 
          VALUES ('$judul_infodes', '$isi_infodes', '$foto_infodes', '$tgl_upload_infodes')";

$exe = mysqli_query($con, $query);

if ($exe) {
    echo json_encode(["success" => "true", "message" => "Data berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . mysqli_error($con)]);
}
?>
