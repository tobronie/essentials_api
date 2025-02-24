<?php

include("db_koneksi.php");
$con = db_koneksi();

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {
    $query = "SELECT `id_nikah`, `ni_judul`, `ni_foto_ktp_pria`, `ni_foto_kk_pria`, `ni_foto_akte_pria`, `ni_foto_formulir_pria`,
    `ni_foto_nikah_ayah_pria`, `ni_foto_nikah_ibu_pria`, `ni_foto_ktp_wanita`, `ni_foto_kk_wanita`, `ni_foto_akte_wanita`,
    `ni_foto_formulir_wanita`, `ni_foto_nikah_ayah_wanita`, `ni_foto_nikah_ibu_wanita`, `ni_surat_konfirmasi`, `ni_tgl_upload`,
    `ni_konfirmasi`
    FROM `nikah`
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