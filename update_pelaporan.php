<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_lapor"])) {
    $id_lapor = $_POST["id_lapor"];
} else
    return;

if (isset($_POST["foto_tanggapan_lapor"])) {
    $foto_tanggapan_lapor = $_POST["foto_tanggapan_lapor"];
} else
    return;

if (isset($_POST["tgl_tanggapan_lapor"])) {
    $tgl_tanggapan_lapor = $_POST["tgl_tanggapan_lapor"];
} else
    return;

if (isset($_POST["ket_tanggapan_lapor"])) {
    $ket_tanggapan_lapor = $_POST["ket_tanggapan_lapor"];
} else
    return;

$image_path = "uploads/tanggapan_$id_lapor.jpg";
file_put_contents($image_path, base64_decode($foto_tanggapan_lapor));

$query = "UPDATE pelaporan SET foto_tanggapan_lapor='$image_path', `tgl_tanggapan_lapor`='$tgl_tanggapan_lapor',
`ket_tanggapan_lapor`='$ket_tanggapan_lapor' WHERE id_lapor='$id_lapor'";
$result = mysqli_query($con, $query);

if ($result) {
    echo json_encode(["success" => "true"]);
} else {
    echo json_encode(["success" => "false"]);
}
?>