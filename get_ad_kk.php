<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_kk = isset($_GET['id_kk']) ? $_GET['id_kk'] : null;

if ($id_kk) {
    $query = "SELECT kk.id_kk, kk.id_user, user.nama AS nama, user.no_hp AS no_hp, user.email AS email, kk.kk_judul, kk.kk_foto_kk, kk.kk_foto_nikah_ayah,
    kk.kk_foto_nikah_ibu, kk.kk_foto_ijasah_keluarga, kk.kk_foto_akte_keluarga, kk.kk_surat_konfirmasi, kk.kk_tgl_upload, kk.kk_konfirmasi
    FROM kk
    JOIN user ON kk.id_user = user.id_user
    WHERE id_kk = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_kk);
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