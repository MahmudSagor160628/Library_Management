<?php
include ('../connect.php');
$conn = connectDB();
$eid = $_GET['id'];
$id = base64_decode($eid);
echo $id;
$sql = "UPDATE `students` SET `status` = 0 WHERE id = $id";
$rslt = mysqli_query($conn, $sql);
if ($rslt) {
	header('location:students.php');
}

?>