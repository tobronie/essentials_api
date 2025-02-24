<?php

include("db_koneksi.php");
$con = db_koneksi();

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {
    $query = "SELECT `id_kematian`, `kem_judul`, `kem_nama_almarhum`, `kem_foto_ktp_almarhum`, `kem_foto_kk`,
    `kem_foto_surat_kematian`, `kem_foto_ktp_saksi`, `kem_surat_konfirmasi`, `kem_tgl_upload`, `kem_konfirmasi`
    FROM `kematian`
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