<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_info = isset($_GET['id_info']) ? $_GET['id_info'] : null;

if ($id_info) {
    $query = "SELECT `id_info`, `judul_info`, `kategori_info`, `isi_info`, `foto_info`, `tgl_upload_info`
    FROM `information` WHERE `id_info` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_info);
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