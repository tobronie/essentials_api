<?php

include("db_koneksi.php");
$con = db_koneksi();

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {
    $query = "SELECT `id_usaha`, `us_judul`, `us_foto_ktp`, `us_foto_kk`, `us_omset`, `us_surat_konfirmasi`, `us_tgl_upload`,
    `us_konfirmasi`
    FROM `usaha` 
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