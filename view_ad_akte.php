<?php

include("db_koneksi.php");
$con = db_koneksi();

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {
    $query = "SELECT `id_akte`, `ak_judul`, `ak_foto_surat_kelahiran`, `ak_foto_kk`, `ak_foto_ktp_ayah`, `ak_foto_nikah_ayah`,
    `ak_foto_ktp_ibu`, `ak_foto_nikah_ibu`, `ak_foto_ktp_saksi_satu`, `ak_foto_ktp_saksi_dua`, `ak_foto_ijasah_bersangkutan`,
    `ak_foto_akte_saudara`, `ak_surat_konfirmasi`, `ak_tgl_upload`, `ak_konfirmasi`
    FROM `akte` 
    WHERE `id_user` = ?";

    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    $arr = [];

    while ($row = $result->fetch_assoc()) {
        $arr[] = $row;
    }

    echo json_encode($arr);
} else {
    echo json_encode(["error" => "ID User tidak ditemukan"]);
}

?>