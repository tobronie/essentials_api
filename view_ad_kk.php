<?php

include("db_koneksi.php");
$con = db_koneksi();

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {
    $query = "SELECT `id_kk`, `kk_judul`, `kk_foto_kk`, `kk_foto_nikah_ayah`, `kk_foto_nikah_ibu`, `kk_foto_ijasah_keluarga`,
    `kk_foto_akte_keluarga`, `kk_surat_konfirmasi`, `kk_tgl_upload`, `kk_konfirmasi`
    FROM `kk`
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