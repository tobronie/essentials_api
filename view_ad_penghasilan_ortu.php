<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_penghasilan`, `has_judul`, `has_pekerjaan_ayah`, `has_pendapatan_ayah`, `has_pekerjaan_ibu`,
`has_pendapatan_ibu`, `has_foto_ktp`, `has_foto_kk`, `has_foto_pendukung_ayah`, `has_foto_pendukung_ibu`,
`has_surat_konfirmasi`, `has_tgl_upload` FROM `penghasilan_ortu`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>