<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_akte`, `ak_judul`, `ak_foto_surat_kelahiran`, `ak_foto_kk`, `ak_foto_ktp_ayah`, `ak_foto_nikah_ayah`,
    `ak_foto_ktp_ibu`, `ak_foto_nikah_ibu`, `ak_foto_ktp_saksi_satu`, `ak_foto_ktp_saksi_dua`, `ak_foto_ijasah_bersangkutan`,
    `ak_foto_akte_saudara`, `ak_surat_konfirmasi`, `ak_tgl_upload`, `ak_konfirmasi`
    FROM `akte`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>