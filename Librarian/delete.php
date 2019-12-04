<?php
include('../connect.php');
$conn = connectDB();
if (isset($_GET['id'])) {
	$id = base64_decode($_GET['id']);
	$sq = "SELECT * FROM `books` WHERE id = $id";
	$result = mysqli_query($conn, $sq);
	$row = mysqli_fetch_assoc($result);
	
	$img_loc = '../image/book/'.$row['book_image'];
	
	if (file_exists($img_loc)) {
		unlink($img_loc);
	}
	$sql = "DELETE FROM `books` WHERE id = $id";
	$rslt = mysqli_query($conn, $sql);
	if ($rslt) {
		header('location: manage_book.php');
	}
}


?>