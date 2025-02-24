<?php

include("db_koneksi.php");
$con = db_koneksi();

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {
    $query = "SELECT `id_sktm`, `sktm_judul`, `sktm_nama_wali`, `sktm_nominal`, `sktm_rincian`, `sktm_foto_ktp`, `sktm_foto_kk`,
    `sktm_surat_konfirmasi`, `sktm_tgl_upload`, `sktm_konfirmasi`
    FROM `sktm` 
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