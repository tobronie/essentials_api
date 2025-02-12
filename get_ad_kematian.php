<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_kematian = isset($_GET['id_kematian']) ? $_GET['id_kematian'] : null;

if ($id_kematian) {
    $query = "SELECT `id_kematian`, `kem_judul`, `kem_nama_almarhum`, `kem_foto_ktp_almarhum`, `kem_foto_kk`,
`kem_foto_surat_kematian`, `kem_foto_ktp_saksi`, `kem_surat_konfirmasi`, `kem_tgl_upload` FROM `kematian` WHERE `id_kematian` = ?";
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