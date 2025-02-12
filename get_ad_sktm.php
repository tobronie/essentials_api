<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_sktm = isset($_GET['id_sktm']) ? $_GET['id_sktm'] : null;

if ($id_sktm) {
    $query = "SELECT `id_sktm`, `sktm_judul`, `sktm_nama_wali`, `sktm_nominal`, `sktm_rincian`, `sktm_foto_ktp`, `sktm_foto_kk`,
`sktm_surat_konfirmasi`, `sktm_tgl_upload` FROM `sktm` WHERE `id_sktm` = ?";
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