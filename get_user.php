<?php
include("db_koneksi.php");
$con = db_koneksi();

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user) {
    $query = "SELECT user.id_user, user.nama, user.nik, user.kk, user.dusun, user.rt, user.rw, user.pekerjaan, user.no_hp,
    user.email, user.password, user.profil
    FROM user WHERE id_user = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo json_encode(["error" => "ID tidak ditemukan"]);
}
?>