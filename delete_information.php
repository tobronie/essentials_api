<?php
include("db_koneksi.php");
$con = db_koneksi();

if(isset($_POST["id"]))
{
    $id=$_POST["id"];
}
else return;

$query = "DELETE FROM `information` WHERE id_info='$id'";
$exe = mysqli_query($con, $query);

$arr = [];
if ($exe) {
    $arr["success"] = "true";
} else {
    $arr["success"] = "false";
}

print (json_encode($arr));

?>