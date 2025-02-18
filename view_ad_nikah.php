<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_nikah`, `ni_judul`, `ni_foto_ktp_pria`, `ni_foto_kk_pria`, `ni_foto_akte_pria`, `ni_foto_formulir_pria`,
`ni_foto_nikah_ayah_pria`, `ni_foto_nikah_ibu_pria`, `ni_foto_ktp_wanita`, `ni_foto_kk_wanita`, `ni_foto_akte_wanita`,
`ni_foto_formulir_wanita`, `ni_foto_nikah_ayah_wanita`, `ni_foto_nikah_ibu_wanita`, `ni_surat_konfirmasi`, `ni_tgl_upload`,
`ni_konfirmasi` FROM `nikah`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>