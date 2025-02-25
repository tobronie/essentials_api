<?php
include("db_koneksi.php");
$con = db_koneksi();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["id_user"], $_POST["pen_judul"], $_POST["pen_daerah_asal"], $_POST["pen_daerah_tujuan"], $_POST["pen_surat_konfirmasi"], $_POST["pen_tgl_upload"], $_POST["pen_konfirmasi"])) {
    echo json_encode(["success" => "false", "message" => "Data tidak lengkap"]);
    exit;
}

$id_user = mysqli_real_escape_string($con, $_POST["id_user"]);
$pen_judul = mysqli_real_escape_string($con, $_POST["pen_judul"]);
$pen_daerah_asal = mysqli_real_escape_string($con, $_POST["pen_daerah_asal"]);
$pen_daerah_tujuan = mysqli_real_escape_string($con, $_POST["pen_daerah_tujuan"]);
$pen_surat_konfirmasi = mysqli_real_escape_string($con, $_POST["pen_surat_konfirmasi"]);
$pen_tgl_upload = mysqli_real_escape_string($con, $_POST["pen_tgl_upload"]);
$pen_konfirmasi = mysqli_real_escape_string($con, $_POST["pen_konfirmasi"]);

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

$pen_foto_ktp = uploadFile("pen_foto_ktp", $upload_dir);
$pen_foto_kk = uploadFile("pen_foto_kk", $upload_dir);
$pen_foto_nikah_pria = uploadFile("pen_foto_nikah_pria", $upload_dir);
$pen_foto_nikah_wanita = uploadFile("pen_foto_nikah_wanita", $upload_dir);

$query = "INSERT INTO `pendudukan` (`id_user`, `pen_judul`, `pen_foto_ktp`, `pen_foto_kk`, `pen_foto_nikah_pria`, 
    `pen_foto_nikah_wanita`, `pen_daerah_asal`, `pen_daerah_tujuan`, `pen_surat_konfirmasi`, `pen_tgl_upload`, 
    `pen_konfirmasi`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param(
    "issssssssss",
    $id_user,
    $pen_judul,
    $pen_foto_ktp,
    $pen_foto_kk,
    $pen_foto_nikah_pria,
    $pen_foto_nikah_wanita,
    $pen_daerah_asal,
    $pen_daerah_tujuan,
    $pen_surat_konfirmasi,
    $pen_tgl_upload,
    $pen_konfirmasi
);

if ($stmt->execute()) {
    echo json_encode(["success" => "true", "message" => "Data Pendudukan berhasil disimpan"]);
} else {
    echo json_encode(["success" => "false", "message" => "SQL Error: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
