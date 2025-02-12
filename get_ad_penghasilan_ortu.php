<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_penghasilan = isset($_GET['id_penghasilan']) ? $_GET['id_penghasilan'] : null;

if ($id_penghasilan) {
    $query = "SELECT `id_penghasilan`, `has_judul`, `has_pekerjaan_ayah`, `has_pendapatan_ayah`, `has_pekerjaan_ibu`,
`has_pendapatan_ibu`, `has_foto_penghasilan`, `has_foto_kk`, `has_foto_pendukung_ayah`, `has_foto_pendukung_ibu`,
`has_surat_konfirmasi`, `has_tgl_upload` FROM `penghasilan_ortu` WHERE `id_penghasilan` = ?";
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