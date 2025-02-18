<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_usaha = isset($_GET['id_usaha']) ? $_GET['id_usaha'] : null;

if ($id_usaha) {
    $query = "SELECT usaha.id_usaha, usaha.id_user, user.nama AS nama, user.no_hp AS no_hp, user.email AS email, usaha.us_judul, usaha.us_foto_ktp, usaha.us_foto_kk,
    usaha.us_omset, usaha.us_surat_konfirmasi, usaha.us_tgl_upload, usaha.us_konfirmasi
    FROM usaha
    JOIN user ON usaha.id_user = user.id_user
    WHERE id_usaha = ? LIMIT 1";
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