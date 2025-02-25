<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["id_user"], $_POST["tan_judul"], $_POST["tan_surat_konfirmasi"], $_POST["tan_tgl_upload"], $_POST["tan_konfirmasi"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$tan_judul = mysqli_real_escape_string($con, $_POST["tan_judul"]);
$tan_surat_konfirmasi = mysqli_real_escape_string($con, $_POST["tan_surat_konfirmasi"]);
$tan_tgl_upload = mysqli_real_escape_string($con, $_POST["tan_tgl_upload"]);
$tan_konfirmasi = mysqli_real_escape_string($con, $_POST["tan_konfirmasi"]);

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

$tan_foto_ktp = uploadFile("tan_foto_ktp", $upload_dir);
$tan_foto_kk = uploadFile("tan_foto_kk", $upload_dir);
$tan_foto_sppt_shm = uploadFile("tan_foto_sppt_shm", $upload_dir);

$query = "INSERT INTO `tanah` (`id_user`, `tan_judul`, `tan_foto_ktp`, `tan_foto_kk`, `tan_foto_sppt_shm`,
    `tan_surat_konfirmasi`, `tan_tgl_upload`, `tan_konfirmasi`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssss",
    $id_user,
    $tan_judul,
    $tan_foto_ktp,
    $tan_foto_kk,
    $tan_foto_sppt_shm,
    $tan_surat_konfirmasi,
    $tan_tgl_upload,
    $tan_konfirmasi
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Data tanah berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
