<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["id_user"], $_POST["kem_judul"], $_POST["kem_nama_almarhum"], $_POST["kem_surat_konfirmasi"], $_POST["kem_tgl_upload"], $_POST["kem_konfirmasi"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$kem_judul = mysqli_real_escape_string($con, $_POST["kem_judul"]);
$kem_nama_almarhum = mysqli_real_escape_string($con, $_POST["kem_nama_almarhum"]);
$kem_surat_konfirmasi = mysqli_real_escape_string($con, $_POST["kem_surat_konfirmasi"]);
$kem_tgl_upload = mysqli_real_escape_string($con, $_POST["kem_tgl_upload"]);
$kem_konfirmasi = mysqli_real_escape_string($con, $_POST["kem_konfirmasi"]);

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

$kem_foto_ktp_almarhum = uploadFile("kem_foto_ktp_almarhum", $upload_dir);
$kem_foto_kk = uploadFile("kem_foto_kk", $upload_dir);
$kem_foto_surat_kematian = uploadFile("kem_foto_surat_kematian", $upload_dir);
$kem_foto_ktp_saksi = uploadFile("kem_foto_ktp_saksi", $upload_dir);

$query = "INSERT INTO `kematian` (`id_user`, `kem_judul`, `kem_nama_almarhum`, `kem_foto_ktp_almarhum`, `kem_foto_kk`, 
          `kem_foto_surat_kematian`, `kem_foto_ktp_saksi`, `kem_surat_konfirmasi`, `kem_tgl_upload`, `kem_konfirmasi`) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssssss",
    $id_user,
    $kem_judul,
    $kem_nama_almarhum,
    $kem_foto_ktp_almarhum,
    $kem_foto_kk,
    $kem_foto_surat_kematian,
    $kem_foto_ktp_saksi,
    $kem_surat_konfirmasi,
    $kem_tgl_upload,
    $kem_konfirmasi
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Data kematian berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
