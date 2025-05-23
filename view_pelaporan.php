<?php

include("db_koneksi.php");
$con = db_koneksi();

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {
    $query = "SELECT `id_lapor`, `judul_lapor`, `waktu_lapor`, `lokasi_lapor`, `isi_lapor`, `foto_lapor`, `tgl_upload_lapor`, 
    `konfirmasi_lapor`, `foto_tanggapan_lapor`, `tgl_tanggapan_lapor`, `ket_tanggapan_lapor` 
    FROM `pelaporan`
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