<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_kematian = isset($_GET['id_kematian']) ? $_GET['id_kematian'] : null;

if ($id_kematian) {
    $query = "SELECT kematian.id_kematian, kematian.id_user, user.nama AS nama, user.no_hp AS no_hp, user.email AS email, kematian.kem_judul,
    kematian.kem_nama_almarhum, kematian.kem_foto_ktp_almarhum, kematian.kem_foto_kk, kematian.kem_foto_surat_kematian,
    kematian.kem_foto_ktp_saksi, kematian.kem_surat_konfirmasi, kematian.kem_tgl_upload
    FROM kematian
    JOIN user ON kematian.id_user = user.id_user
    WHERE id_kematian = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_kematian);
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