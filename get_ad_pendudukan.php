<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_pendudukan = isset($_GET['id_pendudukan']) ? $_GET['id_pendudukan'] : null;

if ($id_pendudukan) {
    $query = "SELECT pendudukan.id_pendudukan, pendudukan.id_user, user.nama AS nama, user.no_hp AS no_hp, user.email AS email, pendudukan.pen_judul,
    pendudukan.pen_foto_ktp, pendudukan.pen_foto_kk, pendudukan.pen_foto_nikah_pria, pendudukan.pen_foto_nikah_wanita,
    pendudukan.pen_daerah_asal, pendudukan.pen_daerah_tujuan, pendudukan.pen_surat_konfirmasi, pendudukan.pen_tgl_upload
    FROM pendudukan
    JOIN user ON pendudukan.id_user = user.id_user
    WHERE id_pendudukan = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_pendudukan);
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