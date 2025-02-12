<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_lapor = isset($_GET['id_lapor']) ? $_GET['id_lapor'] : null;

if ($id_lapor) {
    $query = "SELECT pelaporan.id_lapor, pelaporan.id_user, user.nama AS nama, 
                 pelaporan.judul_lapor, pelaporan.lokasi_lapor, pelaporan.waktu_lapor, 
                 pelaporan.isi_lapor, pelaporan.foto_lapor, pelaporan.tgl_upload_lapor 
          FROM pelaporan
          JOIN user ON pelaporan.id_user = user.id_user
          WHERE pelaporan.id_lapor = ? LIMIT 1";

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