<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_lapor = isset($_GET['id_lapor']) ? $_GET['id_lapor'] : null;

if ($id_lapor) {
    $query = "SELECT `id_lapor`, `judul_lapor`, `lokasi_lapor`, `waktu_lapor`, `isi_lapor`, `foto_lapor`, `tgl_upload_lapor` FROM `pelaporan` WHERE `id_lapor` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_lapor);
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