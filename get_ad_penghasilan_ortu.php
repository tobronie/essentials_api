<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_penghasilan = isset($_GET['id_penghasilan']) ? $_GET['id_penghasilan'] : null;

if ($id_penghasilan) {
    $query = "SELECT penghasilan_ortu.id_penghasilan, penghasilan_ortu.id_user, user.nama AS nama, penghasilan_ortu.has_judul,
    penghasilan_ortu.has_pekerjaan_ayah, penghasilan_ortu.has_pendapatan_ayah, penghasilan_ortu.has_pekerjaan_ibu,
    penghasilan_ortu.has_pendapatan_ibu, penghasilan_ortu.has_foto_ktp, penghasilan_ortu.has_foto_kk,
    penghasilan_ortu.has_foto_pendukung_ayah, penghasilan_ortu.has_foto_pendukung_ibu, penghasilan_ortu.has_surat_konfirmasi,
    penghasilan_ortu.has_tgl_upload
    FROM penghasilan_ortu
    JOIN user ON penghasilan_ortu.id_user = user.id_user
    WHERE id_penghasilan = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_penghasilan);
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