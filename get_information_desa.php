<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_infodes = isset($_GET['id_infodes']) ? $_GET['id_infodes'] : null;

if ($id_infodes) {
    $query = "SELECT `id_infodes`, `judul_infodes`, `isi_infodes`, `foto_infodes`, `tgl_upload_infodes`
    FROM `information_desa` WHERE `id_infodes` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_infodes);
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