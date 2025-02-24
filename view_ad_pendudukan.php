<?php

include("db_koneksi.php");
$con = db_koneksi();

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {
    $query = "SELECT `id_pendudukan`, `pen_judul`, `pen_foto_ktp`, `pen_foto_kk`, `pen_foto_nikah_pria`, `pen_foto_nikah_wanita`,
    `pen_daerah_asal`, `pen_daerah_tujuan`, `pen_surat_konfirmasi`, `pen_tgl_upload`, `pen_konfirmasi`
    FROM `pendudukan` 
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