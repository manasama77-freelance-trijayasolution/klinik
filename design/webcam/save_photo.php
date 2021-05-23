<?php
include "koneksi.php";
$id 	= $_GET['id'];
$sql 	="SELECT * FROM pat_photo WHERE id_reg ='$id' ";
$result = $conn->query($sql);
$code	= $_POST['jquerypost'];
//echo $code;
if ($result->num_rows > 0) {
	$sql 	="UPDATE pat_photo SET photo = '$code' WHERE title_1 = '$id'";
	$result = $conn->query($sql);
	echo $sql;
} else {
	$sql 	="INSERT pat_photo (id_reg,photo) values('$id', '$code')";
	$result = $conn->query($sql);
	echo $sql;
}
$conn->close();
?>