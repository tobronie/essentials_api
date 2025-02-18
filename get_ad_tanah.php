<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_tanah = isset($_GET['id_tanah']) ? $_GET['id_tanah'] : null;

if ($id_tanah) {
    $query = "SELECT tanah.id_tanah, tanah.id_user, user.nama AS nama, user.no_hp AS no_hp, user.email AS email, tanah.tan_judul, tanah.tan_foto_ktp, tanah.tan_foto_kk,
    tanah.tan_foto_sppt_shm, tanah.tan_surat_konfirmasi, tanah.tan_tgl_upload, tanah.tan_konfirmasi
    FROM tanah
    JOIN user ON tanah.id_user = user.id_user
    WHERE id_tanah = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_tanah);
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