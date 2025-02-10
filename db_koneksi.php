<?php

function db_koneksi()
{
    $con = mysqli_connect("localhost", "root", "Sederhana05#", "essentials");
    return $con;
}

?>