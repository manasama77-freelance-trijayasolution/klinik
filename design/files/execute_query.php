<?php
	$host		="localhost";
	$user		="root";
	$pass		="";
	// $pass		="m355age45";
	$database	="kyoaims";

	$con		=mysqli_connect($host, $user, $pass, $database);
	
//$logic 		="update mst_user set online=1 where id='$id' ";  
//if($hasil 	=mysqli_query($con, $logic)){}

$sql		="select online from mst_user where online=1";
if($results	=mysqli_query($con, $sql)){}
$rowcount=mysqli_num_rows($results);
?>

<?php echo $rowcount;?>

