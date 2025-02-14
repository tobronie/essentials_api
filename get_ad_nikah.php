<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_nikah = isset($_GET['id_nikah']) ? $_GET['id_nikah'] : null;

if ($id_nikah) {
    $query = "SELECT nikah.id_nikah, nikah.id_user, user.nama AS nama, user.no_hp AS no_hp, user.email AS email, nikah.ni_judul, nikah.ni_foto_ktp_pria,
    nikah.ni_foto_kk_pria, nikah.ni_foto_akte_pria, nikah.ni_foto_formulir_pria, nikah.ni_foto_nikah_ayah_pria,
    nikah.ni_foto_nikah_ibu_pria, nikah.ni_foto_ktp_wanita, nikah.ni_foto_kk_wanita, nikah.ni_foto_akte_wanita,
    nikah.ni_foto_formulir_wanita, nikah.ni_foto_nikah_ayah_wanita, nikah.ni_foto_nikah_ibu_wanita,
    nikah.ni_surat_konfirmasi, nikah.ni_tgl_upload
    FROM nikah
    JOIN user ON nikah.id_user = user.id_user
    WHERE id_nikah = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_nikah);
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