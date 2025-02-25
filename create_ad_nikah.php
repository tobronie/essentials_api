<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["id_user"], $_POST["ni_judul"], $_POST["ni_surat_konfirmasi"], $_POST["ni_tgl_upload"], $_POST["ni_konfirmasi"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$ni_judul = mysqli_real_escape_string($con, $_POST["ni_judul"]);
$ni_surat_konfirmasi = mysqli_real_escape_string($con, $_POST["ni_surat_konfirmasi"]);
$ni_tgl_upload = mysqli_real_escape_string($con, $_POST["ni_tgl_upload"]);
$ni_konfirmasi = mysqli_real_escape_string($con, $_POST["ni_konfirmasi"]);

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

$ni_foto_ktp_pria = uploadFile("ni_foto_ktp_pria", $upload_dir);
$ni_foto_kk_pria = uploadFile("ni_foto_kk_pria", $upload_dir);
$ni_foto_akte_pria = uploadFile("ni_foto_akte_pria", $upload_dir);
$ni_foto_formulir_pria = uploadFile("ni_foto_formulir_pria", $upload_dir);
$ni_foto_nikah_ayah_pria = uploadFile("ni_foto_nikah_ayah_pria", $upload_dir);
$ni_foto_nikah_ibu_pria = uploadFile("ni_foto_nikah_ibu_pria", $upload_dir);
$ni_foto_ktp_wanita = uploadFile("ni_foto_ktp_wanita", $upload_dir);
$ni_foto_kk_wanita = uploadFile("ni_foto_kk_wanita", $upload_dir);
$ni_foto_akte_wanita = uploadFile("ni_foto_akte_wanita", $upload_dir);
$ni_foto_formulir_wanita = uploadFile("ni_foto_formulir_wanita", $upload_dir);
$ni_foto_nikah_ayah_wanita = uploadFile("ni_foto_nikah_ayah_wanita", $upload_dir);
$ni_foto_nikah_ibu_wanita = uploadFile("ni_foto_nikah_ibu_wanita", $upload_dir);

$query = "INSERT INTO `nikah` (`id_user`, `ni_judul`, `ni_foto_ktp_pria`, `ni_foto_kk_pria`, `ni_foto_akte_pria`, `ni_foto_formulir_pria`, 
    `ni_foto_nikah_ayah_pria`, `ni_foto_nikah_ibu_pria`, `ni_foto_ktp_wanita`, `ni_foto_kk_wanita`, `ni_foto_akte_wanita`, 
    `ni_foto_formulir_wanita`, `ni_foto_nikah_ayah_wanita`, `ni_foto_nikah_ibu_wanita`, `ni_surat_konfirmasi`, `ni_tgl_upload`, `ni_konfirmasi`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "issssssssssssssss",
    $id_user,
    $ni_judul,
    $ni_foto_ktp_pria,
    $ni_foto_kk_pria,
    $ni_foto_akte_pria,
    $ni_foto_formulir_pria,
    $ni_foto_nikah_ayah_pria,
    $ni_foto_nikah_ibu_pria,
    $ni_foto_ktp_wanita,
    $ni_foto_kk_wanita,
    $ni_foto_akte_wanita,
    $ni_foto_formulir_wanita,
    $ni_foto_nikah_ayah_wanita,
    $ni_foto_nikah_ibu_wanita,
    $ni_surat_konfirmasi,
    $ni_tgl_upload,
    $ni_konfirmasi
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Data Nikah berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
