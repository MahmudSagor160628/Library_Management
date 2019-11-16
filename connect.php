<?php
function connectDB(){
	$conn = mysqli_connect('localhost', 'root', '', 'library_management');
	return $conn;
}

?>