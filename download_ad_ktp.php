<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_ktp = $_GET['id_ktp'] ?? null;
if (!$id_ktp) {
    http_response_code(400);
    echo "ID ktp tidak diberikan.";
    exit();
}

$query = "SELECT kt_surat_konfirmasi FROM ktp WHERE id_ktp = ? LIMIT 1";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id_ktp);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $filePath = $row['kt_surat_konfirmasi'];

    if ($filePath && file_exists($filePath)) {
        if (ob_get_length()) {
            ob_end_clean();
        }

        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"" . basename($filePath) . "\"");
        header("Content-Length: " . filesize($filePath));
        readfile($filePath);
        exit();
    } else {
        http_response_code(404);
        echo "File tidak ditemukan.";
    }
} else {
    http_response_code(404);
    echo "File tidak ditemukan.";
}
?>
