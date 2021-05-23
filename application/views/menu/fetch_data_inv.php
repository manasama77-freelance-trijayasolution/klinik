<?php
	 include './design/koneksi/file.php';
      
	 $state = $_POST['get_option'];
	 // $q = intval($_GET['q']);
     $find=mysqli_query($con,"select lab_item_seq_no+1 id from mst_lab_item where lab_item_group='$state' order by lab_item_seq_no desc limit 1");

	if(mysqli_num_rows($find)== 0){
			echo "<input class='input-xlarge focused' value='1' name='item_seq' type='text' readonly>";	
	}
	else{
	while($row=mysqli_fetch_array($find))

		{	 
			echo "<input class='input-xlarge focused' value=".$row['id']." name='item_seq' type='text' readonly>";	
		}
	}
    exit;
   

?>