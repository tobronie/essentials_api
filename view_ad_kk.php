<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_kk`, `kk_judul`, `kk_foto_kk`, `kk_foto_nikah_ayah`, `kk_foto_nikah_ibu`, `kk_foto_ijasah_keluarga`, 
`kk_foto_akte_keluarga`, `kk_surat_konfirmasi`, `kk_tgl_upload` FROM `kk`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>