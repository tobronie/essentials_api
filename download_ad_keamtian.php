<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_kematian = $_GET['id_kematian'] ?? null;
if (!$id_kematian) {
    http_response_code(400);
    echo "ID kematian tidak diberikan.";
    exit();
}

$query = "SELECT kem_surat_konfirmasi FROM kematian WHERE id_kematian = ? LIMIT 1";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id_kematian);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $filePath = $row['kem_surat_konfirmasi'];

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
