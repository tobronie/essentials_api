<?php
include("db_koneksi.php");
$con = db_koneksi();

if (!isset($_POST["id_domisili"]) || !isset($_FILES["dom_surat_konfirmasi"])) {
    echo json_encode(["success" => "false"]);
    return;
}

$id_domisili = $_POST["id_domisili"];
$file = $_FILES["dom_surat_konfirmasi"];

$allowed_types = ['application/pdf'];
if (!in_array($file['type'], $allowed_types)) {
    echo json_encode(["success" => "false"]);
    return;
}

$upload_dir = "uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$file_path = $upload_dir . basename($file["name"]);

if (move_uploaded_file($file["tmp_name"], $file_path)) {
    $query = "UPDATE `domisili` SET `dom_surat_konfirmasi`=? WHERE `id_domisili`=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "si", $file_path, $id_domisili);
    $exe = mysqli_stmt_execute($stmt);

    if ($exe) {
        echo json_encode(["success" => "true"]);
    } else {
        echo json_encode(["success" => "false"]);
    }
} else {
    echo json_encode(["success" => "false"]);
}
?>
