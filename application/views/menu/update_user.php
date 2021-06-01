			<?php
			include './design/koneksi/file.php';
			$url 		= $this->uri->segment(1);
			if($url=="home"){	
			$logic 		="update mst_user set online=1 where id='$id' ";  
			if($hasil 	=mysqli_query($con, $logic)){}
			}else{
			$logic 		="update mst_user set online=0 where id='$id' ";  
			if($hasil 	=mysqli_query($con, $logic)){}
			}
			?>