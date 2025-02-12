<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_sktm`, `sktm_judul`, `sktm_nama_wali`, `sktm_nominal`, `sktm_rincian`, `sktm_foto_ktp`, `sktm_foto_kk`,
`sktm_surat_konfirmasi`, `sktm_tgl_upload` FROM `sktm`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>