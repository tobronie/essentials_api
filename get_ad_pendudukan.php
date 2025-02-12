<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_pendudukan = isset($_GET['id_pendudukan']) ? $_GET['id_pendudukan'] : null;

if ($id_pendudukan) {
    $query = "SELECT `id_pendudukan`, `pen_judul`, `pen_foto_ktp`, `pen_foto_kk`, `pen_foto_nikah_pria`, `pen_foto_nikah_wanita`,
`pen_daerah_asal`, `pen_daerah_tujuan`, `pen_surat_konfirmasi`, `pen_tgl_upload` FROM `pendudukan` WHERE `id_pendudukan` = ?";
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