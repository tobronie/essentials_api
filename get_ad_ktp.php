<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_ktp = isset($_GET['id_ktp']) ? $_GET['id_ktp'] : null;

if ($id_ktp) {
    $query = "SELECT `id_ktp`, `kt_judul`, `kt_foto_akte`, `kt_foto_kk`, `kt_foto_formulir`, `kt_surat_konfirmasi`,
`kt_tgl_upload` FROM `ktp` WHERE `id_ktp` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_ktp);
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