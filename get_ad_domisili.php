<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_domisili = isset($_GET['id_domisili']) ? $_GET['id_domisili'] : null;

if ($id_domisili) {
    $query = "SELECT `id_domisili`, `dom_judul`, `dom_foto_ktp`, `dom_foto_kk`, `dom_surat_konfirmasi`, `dom_tgl_upload`
FROM `domisili` WHERE `id_domisili` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_domisili);
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