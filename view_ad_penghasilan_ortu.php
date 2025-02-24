<?php

include("db_koneksi.php");
$con = db_koneksi();

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {
    $query = "SELECT `id_penghasilan`, `has_judul`, `has_pekerjaan_ayah`, `has_pendapatan_ayah`, `has_pekerjaan_ibu`,
    `has_pendapatan_ibu`, `has_foto_ktp`, `has_foto_kk`, `has_foto_pendukung_ayah`, `has_foto_pendukung_ibu`,
    `has_surat_konfirmasi`, `has_tgl_upload`, `has_konfirmasi`
    FROM `penghasilan_ortu` 
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