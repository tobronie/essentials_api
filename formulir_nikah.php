<?php
include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT formulir_nikah FROM formulir LIMIT 1";
$exe = mysqli_query($con, $query);

if ($row = mysqli_fetch_assoc($exe)) {
    $pdfData = $row['formulir_nikah'];

    if ($pdfData) {
        if (ob_get_length()) {
            ob_end_clean(); 
        }

        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=formulir-nikah.pdf");
        header("Content-Length: " . strlen($pdfData));

        echo $pdfData;
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
