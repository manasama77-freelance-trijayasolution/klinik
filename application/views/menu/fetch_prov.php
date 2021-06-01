<?php
	 include './design/koneksi/file.php';
	 $state 	=$_POST['get_option'];
     $find		="select * from mst_kota where provinsi_id='$state' order by kota_id asc";
	 $result 	=mysqli_query($con, $find)
	 ?>
     <select name="pat_city">
	 <?php
	  while($row = $result->fetch_array()){	 
    ?>
	<option value="<?=$row['kota_id'];?>" align="justify"><?=$row['nama_kota'];?></option>
	<?php
     }
	 ?>
	</select>
	 <?php
     exit;
?>