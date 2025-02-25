<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (
    !isset(
    $_POST["id_user"],
    $_POST["ak_judul"],
    $_POST["ak_surat_konfirmasi"],
    $_POST["ak_tgl_upload"],
    $_POST["ak_konfirmasi"]
)
) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$ak_judul = mysqli_real_escape_string($con, $_POST["ak_judul"]);
$ak_surat_konfirmasi = mysqli_real_escape_string($con, $_POST["ak_surat_konfirmasi"]);
$ak_tgl_upload = mysqli_real_escape_string($con, $_POST["ak_tgl_upload"]);
$ak_konfirmasi = mysqli_real_escape_string($con, $_POST["ak_konfirmasi"]);

$upload_dir = "uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

function uploadFile($file_key, $upload_dir)
{
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


$ak_foto_surat_kelahiran = uploadFile("ak_foto_surat_kelahiran", $upload_dir);
$ak_foto_kk = uploadFile("ak_foto_kk", $upload_dir);
$ak_foto_ktp_ayah = uploadFile("ak_foto_ktp_ayah", $upload_dir);
$ak_foto_nikah_ayah = uploadFile("ak_foto_nikah_ayah", $upload_dir);
$ak_foto_ktp_ibu = uploadFile("ak_foto_ktp_ibu", $upload_dir);
$ak_foto_nikah_ibu = uploadFile("ak_foto_nikah_ibu", $upload_dir);
$ak_foto_ktp_saksi_satu = uploadFile("ak_foto_ktp_saksi_satu", $upload_dir);
$ak_foto_ktp_saksi_dua = uploadFile("ak_foto_ktp_saksi_dua", $upload_dir);
$ak_foto_ijasah_bersangkutan = uploadFile("ak_foto_ijasah_bersangkutan", $upload_dir);
$ak_foto_akte_saudara = uploadFile("ak_foto_akte_saudara", $upload_dir);

$query = "INSERT INTO `akte` (`id_user`, `ak_judul`, `ak_foto_surat_kelahiran`, `ak_foto_kk`, `ak_foto_ktp_ayah`, `ak_foto_nikah_ayah`,
    `ak_foto_ktp_ibu`, `ak_foto_nikah_ibu`, `ak_foto_ktp_saksi_satu`, `ak_foto_ktp_saksi_dua`, `ak_foto_ijasah_bersangkutan`,
    `ak_foto_akte_saudara`, `ak_surat_konfirmasi`, `ak_tgl_upload`, `ak_konfirmasi`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "issssssssssssss",
    $id_user,
    $ak_judul,
    $ak_foto_surat_kelahiran,
    $ak_foto_kk,
    $ak_foto_ktp_ayah,
    $ak_foto_nikah_ayah,
    $ak_foto_ktp_ibu,
    $ak_foto_nikah_ibu,
    $ak_foto_ktp_saksi_satu,
    $ak_foto_ktp_saksi_dua,
    $ak_foto_ijasah_bersangkutan,
    $ak_foto_akte_saudara,
    $ak_surat_konfirmasi,
    $ak_tgl_upload,
    $ak_konfirmasi
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Data akte berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>