<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["id_user"], $_POST["sktm_judul"], $_POST["sktm_nama_wali"], $_POST["sktm_nominal"], $_POST["sktm_rincian"], $_POST["sktm_surat_konfirmasi"], $_POST["sktm_tgl_upload"], $_POST["sktm_konfirmasi"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$sktm_judul = mysqli_real_escape_string($con, $_POST["sktm_judul"]);
$sktm_nama_wali = mysqli_real_escape_string($con, $_POST["sktm_nama_wali"]);
$sktm_nominal = mysqli_real_escape_string($con, $_POST["sktm_nominal"]);
$sktm_rincian = mysqli_real_escape_string($con, $_POST["sktm_rincian"]);
$sktm_surat_konfirmasi = mysqli_real_escape_string($con, $_POST["sktm_surat_konfirmasi"]);
$sktm_tgl_upload = mysqli_real_escape_string($con, $_POST["sktm_tgl_upload"]);
$sktm_konfirmasi = mysqli_real_escape_string($con, $_POST["sktm_konfirmasi"]);

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

$sktm_foto_ktp = uploadFile("sktm_foto_ktp", $upload_dir);
$sktm_foto_kk = uploadFile("sktm_foto_kk", $upload_dir);

$query = "INSERT INTO `sktm` (`id_user`, `sktm_judul`, `sktm_nama_wali`, `sktm_nominal`, `sktm_rincian`, `sktm_foto_ktp`,
    `sktm_foto_kk`, `sktm_surat_konfirmasi`, `sktm_tgl_upload`, `sktm_konfirmasi`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssssss",
    $id_user,
    $sktm_judul,
    $sktm_nama_wali,
    $sktm_nominal,
    $sktm_rincian,
    $sktm_foto_ktp,
    $sktm_foto_kk,
    $sktm_surat_konfirmasi,
    $sktm_tgl_upload,
    $sktm_konfirmasi
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Data SKTM berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
