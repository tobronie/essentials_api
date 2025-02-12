<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_domisili = isset($_GET['id_domisili']) ? $_GET['id_domisili'] : null;

if ($id_domisili) {
    $query = "SELECT domisili.id_domisili, domisili.id_user, user.nama AS nama, domisili.dom_judul, domisili.dom_foto_ktp,
    domisili.dom_foto_kk, domisili.dom_surat_konfirmasi, domisili.dom_tgl_upload
    FROM domisili
    JOIN user ON domisili.id_user = user.id_user
    WHERE id_domisili = ? LIMIT 1";
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