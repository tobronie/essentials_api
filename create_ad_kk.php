<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["id_user"], $_POST["kk_judul"], $_POST["kk_surat_konfirmasi"], $_POST["kk_tgl_upload"], $_POST["kk_konfirmasi"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$kk_judul = mysqli_real_escape_string($con, $_POST["kk_judul"]);
$kk_surat_konfirmasi = mysqli_real_escape_string($con, $_POST["kk_surat_konfirmasi"]);
$kk_tgl_upload = mysqli_real_escape_string($con, $_POST["kk_tgl_upload"]);
$kk_konfirmasi = mysqli_real_escape_string($con, $_POST["kk_konfirmasi"]);

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

$kk_foto_kk = uploadFile("kk_foto_kk", $upload_dir);
$kk_foto_nikah_ayah = uploadFile("kk_foto_nikah_ayah", $upload_dir);
$kk_foto_nikah_ibu = uploadFile("kk_foto_nikah_ibu", $upload_dir);
$kk_foto_ijasah_keluarga = uploadFile("kk_foto_ijasah_keluarga", $upload_dir);
$kk_foto_akte_keluarga = uploadFile("kk_foto_akte_keluarga", $upload_dir);

$query = "INSERT INTO `kk` (`id_user`, `kk_judul`, `kk_foto_kk`, `kk_foto_nikah_ayah`, `kk_foto_nikah_ibu`, `kk_foto_ijasah_keluarga`, 
          `kk_foto_akte_keluarga`, `kk_surat_konfirmasi`, `kk_tgl_upload`, `kk_konfirmasi`) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssssss",
    $id_user,
    $kk_judul,
    $kk_foto_kk,
    $kk_foto_nikah_ayah,
    $kk_foto_nikah_ibu,
    $kk_foto_ijasah_keluarga,
    $kk_foto_akte_keluarga,
    $kk_surat_konfirmasi,
    $kk_tgl_upload,
    $kk_konfirmasi
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Data KK berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
