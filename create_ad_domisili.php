<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["id_user"], $_POST["dom_judul"], $_POST["dom_surat_konfirmasi"], $_POST["dom_tgl_upload"], $_POST["dom_konfirmasi"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$dom_judul = mysqli_real_escape_string($con, $_POST["dom_judul"]);
$dom_surat_konfirmasi = mysqli_real_escape_string($con, $_POST["dom_surat_konfirmasi"]);
$dom_tgl_upload = mysqli_real_escape_string($con, $_POST["dom_tgl_upload"]);
$dom_konfirmasi = mysqli_real_escape_string($con, $_POST["dom_konfirmasi"]);

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

$dom_foto_ktp = uploadFile("dom_foto_ktp", $upload_dir);
$dom_foto_kk = uploadFile("dom_foto_kk", $upload_dir);

$query = "INSERT INTO `domisili` (`id_user`, `dom_judul`, `dom_foto_ktp`, `dom_foto_kk`, `dom_surat_konfirmasi`, `dom_tgl_upload`, `dom_konfirmasi`) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "issssss",
    $id_user,
    $dom_judul,
    $dom_foto_ktp,
    $dom_foto_kk,
    $dom_surat_konfirmasi,
    $dom_tgl_upload,
    $dom_konfirmasi
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Data domisili berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
