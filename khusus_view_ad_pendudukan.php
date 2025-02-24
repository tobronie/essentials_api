<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_pendudukan`, `pen_judul`, `pen_foto_ktp`, `pen_foto_kk`, `pen_foto_nikah_pria`, `pen_foto_nikah_wanita`,
    `pen_daerah_asal`, `pen_daerah_tujuan`, `pen_surat_konfirmasi`, `pen_tgl_upload`, `pen_konfirmasi`
    FROM `pendudukan`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>