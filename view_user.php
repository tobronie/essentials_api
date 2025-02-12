<?php

include("db_koneksi.php");
$con = db_koneksi();

$query = "SELECT `id_user`, `nama`, `nik`, `kk`, `dusun`, `rt`, `rw`, `pekerjaan`, `no_hp`, `email`, `password`, `profil`
FROM `user`";
$exe = mysqli_query($con, $query);

$arr = [];

while ($row = mysqli_fetch_assoc($exe)) {
    $arr[] = $row;
}

print (json_encode($arr));

?>