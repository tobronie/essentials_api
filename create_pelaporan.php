<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["id_user"], $_POST["judul_lapor"], $_POST["waktu_lapor"], $_POST["lokasi_lapor"], 
          $_POST["isi_lapor"], $_POST["tgl_upload_lapor"], $_POST["konfirmasi_lapor"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$judul_lapor = mysqli_real_escape_string($con, $_POST["judul_lapor"]);
$waktu_lapor = mysqli_real_escape_string($con, $_POST["waktu_lapor"]);
$lokasi_lapor = mysqli_real_escape_string($con, $_POST["lokasi_lapor"]);
$isi_lapor = mysqli_real_escape_string($con, $_POST["isi_lapor"]);
$tgl_upload_lapor = mysqli_real_escape_string($con, $_POST["tgl_upload_lapor"]);
$konfirmasi_lapor = mysqli_real_escape_string($con, $_POST["konfirmasi_lapor"]);

$foto_lapor = null;
if (isset($_FILES["foto_lapor"]) && $_FILES["foto_lapor"]["error"] == UPLOAD_ERR_OK) {
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_tmp = $_FILES["foto_lapor"]["tmp_name"];
    $file_name = time() . "_" . basename($_FILES["foto_lapor"]["name"]);
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($file_tmp, $file_path)) {
        $foto_lapor = $file_name;
    } else {
        echo json_encode(["success" => "false", "message" => "Gagal mengunggah gambar"]);
        exit;
    }
}

$query = "INSERT INTO `pelaporan` (`id_user`, `judul_lapor`, `waktu_lapor`, `lokasi_lapor`, `isi_lapor`, `foto_lapor`, `tgl_upload_lapor`, `konfirmasi_lapor`) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssss",
    $id_user,
    $judul_lapor,
    $waktu_lapor,
    $lokasi_lapor,
    $isi_lapor,
    $foto_lapor,
    $tgl_upload_lapor,
    $konfirmasi_lapor
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Laporan berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
