<?php
include("db_koneksi.php");
$con = db_koneksi();

if (isset($_POST["id_user"])) {
    $id_user = $_POST["id_user"];
} else
    return;

if (isset($_POST["profil"])) {
    $profil = $_POST["profil"];
} else
    return;

$image_path = "uploads/profil_$id_user.jpg"; 
file_put_contents($image_path, base64_decode($profil));

$query = "UPDATE user SET profil='$image_path' WHERE id_user='$id_user'";
$result = mysqli_query($con, $query);

if ($result) {
    echo json_encode(["success" => "true"]);
} else {
    echo json_encode(["success" => "false"]);
}
?>