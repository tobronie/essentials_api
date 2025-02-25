<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["id_user"], $_POST["kt_judul"], $_POST["kt_surat_konfirmasi"], $_POST["kt_tgl_upload"], $_POST["kt_konfirmasi"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$kt_judul = mysqli_real_escape_string($con, $_POST["kt_judul"]);
$kt_surat_konfirmasi = mysqli_real_escape_string($con, $_POST["kt_surat_konfirmasi"]);
$kt_tgl_upload = mysqli_real_escape_string($con, $_POST["kt_tgl_upload"]);
$kt_konfirmasi = mysqli_real_escape_string($con, $_POST["kt_konfirmasi"]);

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

$kt_foto_akte = uploadFile("kt_foto_akte", $upload_dir);
$kt_foto_kk = uploadFile("kt_foto_kk", $upload_dir);
$kt_foto_formulir = uploadFile("kt_foto_formulir", $upload_dir);

$query = "INSERT INTO `ktp` (`id_user`, `kt_judul`, `kt_foto_akte`, `kt_foto_kk`, `kt_foto_formulir`, `kt_surat_konfirmasi`, 
          `kt_tgl_upload`, `kt_konfirmasi`) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "isssssss",
    $id_user,
    $kt_judul,
    $kt_foto_akte,
    $kt_foto_kk,
    $kt_foto_formulir,
    $kt_surat_konfirmasi,
    $kt_tgl_upload,
    $kt_konfirmasi
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Data KTP berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
