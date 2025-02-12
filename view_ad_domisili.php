<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_domisili`, `dom_judul`, `dom_foto_ktp`, `dom_foto_kk`, `dom_surat_konfirmasi`, `dom_tgl_upload`
FROM `domisili`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>