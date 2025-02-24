<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_kematian`, `kem_judul`, `kem_nama_almarhum`, `kem_foto_ktp_almarhum`, `kem_foto_kk`,
    `kem_foto_surat_kematian`, `kem_foto_ktp_saksi`, `kem_surat_konfirmasi`, `kem_tgl_upload`, `kem_konfirmasi`
    FROM `kematian`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>