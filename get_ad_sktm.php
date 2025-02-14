<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_sktm = isset($_GET['id_sktm']) ? $_GET['id_sktm'] : null;

if ($id_sktm) {
    $query = "SELECT sktm.id_sktm, sktm.id_user, user.nama AS nama, user.no_hp AS no_hp, user.email AS email, sktm.sktm_judul, sktm.sktm_nama_wali, sktm.sktm_nominal,
    sktm.sktm_rincian, sktm.sktm_foto_ktp, sktm.sktm_foto_kk, sktm.sktm_surat_konfirmasi, sktm.sktm_tgl_upload
    FROM sktm
    JOIN user ON sktm.id_user = user.id_user
    WHERE id_sktm = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_sktm);
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