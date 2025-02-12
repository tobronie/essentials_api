<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_akte = isset($_GET['id_akte']) ? $_GET['id_akte'] : null;

if ($id_akte) {
    $query = "SELECT akte.id_akte, akte.id_user, user.nama AS nama, akte.ak_judul, akte.ak_foto_surat_kelahiran,
    akte.ak_foto_kk, akte.ak_foto_ktp_ayah, akte.ak_foto_nikah_ayah, akte.ak_foto_ktp_ibu, akte.ak_foto_nikah_ibu,
    akte.ak_foto_ktp_saksi_satu, akte.ak_foto_ktp_saksi_dua, akte.ak_foto_ijasah_bersangkutan, akte.ak_foto_akte_saudara,
    akte.ak_surat_konfirmasi, akte.ak_tgl_upload
    FROM akte
    JOIN user ON akte.id_user = user.id_user
    WHERE id_akte = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_akte);
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