<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_kk = isset($_GET['id_kk']) ? $_GET['id_kk'] : null;

if ($id_kk) {
    $query = "SELECT `id_kk`, `kk_judul`, `kk_foto_kk`, `kk_foto_nikah_ayah`, `kk_foto_nikah_ibu`, `kk_foto_ijasah_keluarga`, 
`kk_foto_akte_keluarga`, `kk_surat_konfirmasi`, `kk_tgl_upload` FROM `kk` WHERE `id_kk` = ?";
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