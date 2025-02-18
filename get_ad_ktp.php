<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_ktp = isset($_GET['id_ktp']) ? $_GET['id_ktp'] : null;

if ($id_ktp) {
    $query = "SELECT ktp.id_ktp, ktp.id_user, user.nama AS nama, user.no_hp AS no_hp, user.email AS email, ktp.kt_judul, ktp.kt_foto_akte, ktp.kt_foto_kk,
    ktp.kt_foto_formulir, ktp.kt_surat_konfirmasi, ktp.kt_tgl_upload, ktp.kt_konfirmasi
    FROM ktp
    JOIN user ON ktp.id_user = user.id_user
    WHERE id_ktp = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_ktp);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo json_encode(["error" => "ID tidak ditemukan"]);
}
?>