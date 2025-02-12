<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_akte = isset($_GET['id_akte']) ? $_GET['id_akte'] : null;

if ($id_akte) {
    $query = "SELECT `id_akte`, `ak_judul`, `ak_foto_surat_kelahiran`, `ak_foto_kk`, `ak_foto_ktp_ayah`, `ak_foto_nikah_ayah`,
`ak_foto_ktp_ibu`,`ak_foto_nikah_ibu`, `ak_foto_ktp_saksi_satu`, `ak_foto_ktp_saksi_dua`, `ak_foto_ijasah_bersangkutan`,
`ak_foto_akte_saudara`, `ak_surat_konfirmasi`, `ak_tgl_upload` FROM `akte` WHERE `id_akte` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_akte);
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