<?php
	$host		="localhost";
	$user		="root";
	$pass		="";
	// $pass		="m355age45";
	$database	="kyoaims";
	$con		=mysqli_connect($host, $user, $pass, $database);
	$sql		="select id_quot from mkt_quotation_h order by id_quot desc limit 1";
if($results		=mysqli_query($con, $sql)){}
while ($row = mysqli_fetch_assoc($results)) {
	$hasilnya	= $row['id_quot'];
}
?>
<?php echo $hasilnya;?>