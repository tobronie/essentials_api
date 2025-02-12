<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_usaha = isset($_GET['id_usaha']) ? $_GET['id_usaha'] : null;

if ($id_usaha) {
    $query = "SELECT `id_usaha`, `us_judul`, `us_foto_usaha`, `us_foto_kk`, `us_omset`, `us_surat_konfirmasi`, `us_tgl_upload`
FROM `usaha` WHERE `id_usaha` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_usaha);
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