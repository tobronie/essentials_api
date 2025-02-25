<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["id_user"], $_POST["has_judul"], $_POST["has_pekerjaan_ayah"], $_POST["has_pendapatan_ayah"], $_POST["has_pekerjaan_ibu"], $_POST["has_pendapatan_ibu"], $_POST["has_surat_konfirmasi"], $_POST["has_tgl_upload"], $_POST["has_konfirmasi"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$has_judul = mysqli_real_escape_string($con, $_POST["has_judul"]);
$has_pekerjaan_ayah = mysqli_real_escape_string($con, $_POST["has_pekerjaan_ayah"]);
$has_pendapatan_ayah = mysqli_real_escape_string($con, $_POST["has_pendapatan_ayah"]);
$has_pekerjaan_ibu = mysqli_real_escape_string($con, $_POST["has_pekerjaan_ibu"]);
$has_pendapatan_ibu = mysqli_real_escape_string($con, $_POST["has_pendapatan_ibu"]);
$has_surat_konfirmasi = mysqli_real_escape_string($con, $_POST["has_surat_konfirmasi"]);
$has_tgl_upload = mysqli_real_escape_string($con, $_POST["has_tgl_upload"]);
$has_konfirmasi = mysqli_real_escape_string($con, $_POST["has_konfirmasi"]);

$upload_dir = "uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

function uploadFile($file_key, $upload_dir) {
    if (isset($_FILES[$file_key]) && $_FILES[$file_key]["error"] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES[$file_key]["tmp_name"];
        $file_name = time() . "_" . basename($_FILES[$file_key]["name"]);
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            return $file_name;
        }
    }
    return "";
}

$has_foto_ktp = uploadFile("has_foto_ktp", $upload_dir);
$has_foto_kk = uploadFile("has_foto_kk", $upload_dir);
$has_foto_pendukung_ayah = uploadFile("has_foto_pendukung_ayah", $upload_dir);
$has_foto_pendukung_ibu = uploadFile("has_foto_pendukung_ibu", $upload_dir);

$query = "INSERT INTO `penghasilan_ortu` (`id_user`, `has_judul`, `has_pekerjaan_ayah`, `has_pendapatan_ayah`, 
    `has_pekerjaan_ibu`, `has_pendapatan_ibu`, `has_foto_ktp`, `has_foto_kk`, `has_foto_pendukung_ayah`, 
    `has_foto_pendukung_ibu`, `has_surat_konfirmasi`, `has_tgl_upload`, `has_konfirmasi`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "issssssssssss",
    $id_user,
    $has_judul,
    $has_pekerjaan_ayah,
    $has_pendapatan_ayah,
    $has_pekerjaan_ibu,
    $has_pendapatan_ibu,
    $has_foto_ktp,
    $has_foto_kk,
    $has_foto_pendukung_ayah,
    $has_foto_pendukung_ibu,
    $has_surat_konfirmasi,
    $has_tgl_upload,
    $has_konfirmasi
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Data Penghasilan Orang Tua berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
