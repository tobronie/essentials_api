<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_nikah = isset($_GET['id_nikah']) ? $_GET['id_nikah'] : null;

if ($id_nikah) {
    $query = "SELECT `id_nikah`, `ni_judul`, `ni_foto_nikah_pria`, `ni_foto_kk_pria`, `ni_foto_akte_pria`, `ni_foto_formulir_pria`,
`ni_foto_nikah_ayah_pria`, `ni_foto_nikah_ibu_pria`, `ni_foto_nikah_wanita`, `ni_foto_kk_wanita`, `ni_foto_akte_wanita`,
`ni_foto_formulir_wanita`, `ni_foto_nikah_ayah_wanita`, `ni_foto_nikah_ibu_wanita`, `ni_surat_konfirmasi`, `ni_tgl_upload`
FROM `nikah` WHERE `id_nikah` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_nikah);
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