<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_tanah`, `tan_judul`, `tan_foto_ktp`, `tan_foto_kk`, `tan_foto_sppt_shm`, `tan_surat_konfirmasi`,
`tan_tgl_upload`, `tan_konfirmasi` FROM `tanah`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>