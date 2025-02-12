<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_tanah = isset($_GET['id_tanah']) ? $_GET['id_tanah'] : null;

if ($id_tanah) {
    $query = "SELECT `id_tanah`, `tan_judul`, `tan_foto_ktp`, `tan_foto_kk`, `tan_foto_sppt_shm`, `tan_surat_konfirmasi`,
`tan_tgl_upload` FROM `tanah` WHERE `id_tanah` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_tanah);
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