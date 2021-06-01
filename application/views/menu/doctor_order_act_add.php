		<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
		<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
		<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
		<script src="<?php echo base_url();?>design/vendors/jGrowl/jquery.jgrowl.js"></script>
		<link href="<?php echo base_url();?>design/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen">
		<script>
		function undisableTxt(){
			document.getElementById("myText123").disabled = false;
		}
		
		function goBack(){
			window.history.back();
		}
		
		function popup(b_id){
			window.open("<?php echo base_url();?>patient/find_pat_doc","Popup","height=550, width=880, top=70, left=180 ");
		}
		
		function popup_edit(b_id){
			window.open("<?php echo base_url();?>patient/find_patient_mcu","Popup","height=auto,width=auto,scrollbars=1,"+ 
							"directories=1,location=1,menubar=1," + 
							"resizable=1 status=1,history=1 top = 50 left = 100");
		}
		
		function btntest_onclick(){
			window.location.href = "<?php echo base_url();?>lab/order_lab/edit";
		}
		</script>
		<?php
	function time_elapsed_string1($datetime, $full = false){
    $now 		= new DateTime;
    $ago 		= new DateTime($datetime);
    $diff 		= $now->diff($ago);
    $diff->w 	= floor($diff->d / 7);
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

		?>
		<script>
        $(function() {
			window.onload = $.jGrowl("<b>Last Order Examination</b> : </br> ", { sticky: true });
			window.onload = $.jGrowl("<b>Last Drug Prescription</b> : </br> ", { sticky: true });
        });
		</script>
		<style>
.tg-list {
  text-align: center;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}

.tg-list-item {
  margin: 0 2em;
}

.tgl {
  display: none;
}
.tgl, .tgl:after, .tgl:before, .tgl *, .tgl *:after, .tgl *:before, .tgl + .tgl-btn {
  box-sizing: border-box;
}
.tgl::-moz-selection, .tgl:after::-moz-selection, .tgl:before::-moz-selection, .tgl *::-moz-selection, .tgl *:after::-moz-selection, .tgl *:before::-moz-selection, .tgl + .tgl-btn::-moz-selection {
  background: none;
}
.tgl::selection, .tgl:after::selection, .tgl:before::selection, .tgl *::selection, .tgl *:after::selection, .tgl *:before::selection, .tgl + .tgl-btn::selection {
  background: none;
}
.tgl + .tgl-btn {
  outline: 0;
  display: block;
  width: 4em;
  height: 2em;
  position: relative;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}
.tgl + .tgl-btn:after, .tgl + .tgl-btn:before {
  position: relative;
  display: block;
  content: "";
  width: 50%;
  height: 100%;
}
.tgl + .tgl-btn:after {
  left: 0;
}
.tgl + .tgl-btn:before {
  display: none;
}
.tgl:checked + .tgl-btn:after {
  left: 50%;
}

.tgl-light + .tgl-btn {
  background: #f0f0f0;
  border-radius: 2em;
  padding: 2px;
  -webkit-transition: all .4s ease;
  transition: all .4s ease;
}
.tgl-light + .tgl-btn:after {
  border-radius: 50%;
  background: #fff;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
}
.tgl-light:checked + .tgl-btn {
  background: #9FD6AE;
}

.tgl-ios + .tgl-btn {
  background: #fbfbfb;
  border-radius: 2em;
  padding: 2px;
  -webkit-transition: all .4s ease;
  transition: all .4s ease;
  border: 1px solid #e8eae9;
}
.tgl-ios + .tgl-btn:after {
  border-radius: 2em;
  background: #fbfbfb;
  -webkit-transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
  transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0 4px 0 rgba(0, 0, 0, 0.08);
}
.tgl-ios + .tgl-btn:hover:after {
  will-change: padding;
}
.tgl-ios + .tgl-btn:active {
  box-shadow: inset 0 0 0 2em #e8eae9;
}
.tgl-ios + .tgl-btn:active:after {
  padding-right: .8em;
}
.tgl-ios:checked + .tgl-btn {
  background: #86d993;
}
.tgl-ios:checked + .tgl-btn:active {
  box-shadow: none;
}
.tgl-ios:checked + .tgl-btn:active:after {
  margin-left: -.8em;
}

.tgl-skewed + .tgl-btn {
  overflow: hidden;
  -webkit-transform: skew(-10deg);
          transform: skew(-10deg);
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
  font-family: sans-serif;
  background: #888;
}
.tgl-skewed + .tgl-btn:after, .tgl-skewed + .tgl-btn:before {
  -webkit-transform: skew(10deg);
          transform: skew(10deg);
  display: inline-block;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
  width: 100%;
  text-align: center;
  position: absolute;
  line-height: 2em;
  font-weight: bold;
  color: #fff;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
}
.tgl-skewed + .tgl-btn:after {
  left: 100%;
  content: attr(data-tg-on);
}
.tgl-skewed + .tgl-btn:before {
  left: 0;
  content: attr(data-tg-off);
}
.tgl-skewed + .tgl-btn:active {
  background: #888;
}
.tgl-skewed + .tgl-btn:active:before {
  left: -10%;
}
.tgl-skewed:checked + .tgl-btn {
  background: #86d993;
}
.tgl-skewed:checked + .tgl-btn:before {
  left: -100%;
}
.tgl-skewed:checked + .tgl-btn:after {
  left: 0;
}
.tgl-skewed:checked + .tgl-btn:active:after {
  left: 10%;
}

.tgl-flat + .tgl-btn {
  padding: 2px;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
  background: #fff;
  border: 4px solid #f2f2f2;
  border-radius: 2em;
}
.tgl-flat + .tgl-btn:after {
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
  background: #f2f2f2;
  content: "";
  border-radius: 1em;
}
.tgl-flat:checked + .tgl-btn {
  border: 4px solid #7FC6A6;
}
.tgl-flat:checked + .tgl-btn:after {
  left: 50%;
  background: #7FC6A6;
}

.tgl-flip + .tgl-btn {
  padding: 1px;
  -webkit-transition: all .2s ease;
  transition: all .2s ease;
  font-family: sans-serif;
  -webkit-perspective: 100px;
          perspective: 100px;
}
.tgl-flip + .tgl-btn:after, .tgl-flip + .tgl-btn:before {
  display: inline-block;
  -webkit-transition: all .4s ease;
  transition: all .4s ease;
  width: 105px;
  text-align: center;
  position: absolute;
  line-height: 2em;
  font-weight: bold;
  color: #fff;
  position: absolute;
  top: 0;
  left: 0;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  border-radius: 4px;
}
.tgl-flip + .tgl-btn:after {
  content: attr(data-tg-on);
  background: #02C66F;
  -webkit-transform: rotateY(-180deg);
          transform: rotateY(-180deg);
}
.tgl-flip + .tgl-btn:before {
  background: #FF1959;
  content: attr(data-tg-off);
}
.tgl-flip + .tgl-btn:active:before {
  -webkit-transform: rotateY(-20deg);
          transform: rotateY(-20deg);
}
.tgl-flip:checked + .tgl-btn:before {
  -webkit-transform: rotateY(180deg);
          transform: rotateY(180deg);
}
.tgl-flip:checked + .tgl-btn:after {
  -webkit-transform: rotateY(0);
          transform: rotateY(0);
  left: 0;
  background: #0095FF;
}
.tgl-flip:checked + .tgl-btn:active:after {
  -webkit-transform: rotateY(20deg);
          transform: rotateY(20deg);
}
</style>
		
		<body onload="startTime()">
		<div class="row-fluid">
		  <div class="block">
		    <div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><b>Doctor Order</b></div>
				<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
			</div>
		  <div class="block-content collapse in">
		<div class="span12">
		<form class="form-horizontal" action="<?php echo base_url();?>docter/save_order_lab" method="post" name="mst_pr">
		
        <div class="control-group">
			<label class="control-label" for="focusedInput">ID Registration</label>
			<div class="controls">
			<input class="input-xlarge focused" type="hidden" value="<?=$_POST['id_pat'];?>" name="id_pat">
			<input class="input-xlarge focused" name="pat_mrn" type="text" id="myText01" value="<?=$_POST['pat_mrn'];?>" maxlength="0" autocomplete="off" placeholder=" ... " required>
			<input name="id_reg" type="hidden" id=""  value="<?=$_POST['id_reg'];?>"  autocomplete="off" >	
			<input name="type" type="hidden" value="<?=$_POST['type'];?>"  autocomplete="off" >				
			</div>
        </div>
		
		<div class="control-group">
		<label class="control-label" for="focusedInput">Patient Name</label>
		<div class="controls">
			<input class="input-xlarge focused" name="pat_name" type="text" id="myText02" value="<?=$_POST['pat_name'];?>"  maxlength="0" autocomplete="off" >
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="focusedInput">Charge Rule</label>
		<div class="controls">
			<input class="input-xlarge focused" name="charge_rule" value="<?=$_POST['charge_rule'];?>" type="text" id="myText03" maxlength="0" autocomplete="off">
		</div>
		</div>
		
		<div class="control-group">
		<label class="control-label" for="focusedInput">Age</label>
		<div class="controls">
			<input class="input-xlarge focused" name="pat_age" type="text" id="myText03" value="<?=$_POST['pat_age'];?>" maxlength="0" autocomplete="off">
		</div>
		</div>
					
		<div class="control-group">
		<label class="control-label" for="focusedInput">Company</label>
		<div class="controls">
			<input class="input-xlarge focused" name="client_name" type="text" id="myText03"  value="<?=$_POST['client_name'];?>" maxlength="0" autocomplete="off">
		</div>
		</div>
		
		
		<div class="row-fluid">
		<div class="block">
		<div class="navbar navbar-inner block-header">
		<ul class="nav nav-tabs">
		<li class="active">
		<a href="#6" onMouseOut="this.style.textDecoration=''" onMouseOver="this.style.textDecoration='underline'" data-toggle="tab" style="border-radius: 15px; margin:5px;"><b>SOAP Note</b></a>
		</li>	
		<li>
		<a href="#1" onMouseOut="this.style.textDecoration=''" onMouseOver="this.style.textDecoration='underline'" data-toggle="tab" style="border-radius: 15px; margin:5px;"><b>Lab</b></a>
		</li>
		<li>
		<a href="#7" onMouseOut="this.style.textDecoration=''" onMouseOver="this.style.textDecoration='underline'" data-toggle="tab" style="border-radius: 15px; margin:5px;"><b>Group Items</b></a>
		</li>  
		<li>
		<a href="#2" onMouseOut="this.style.textDecoration=''" onMouseOver="this.style.textDecoration='underline'" data-toggle="tab" style="border-radius: 15px; margin:5px;"><b>Radiology</b></a>
		</li>  
		<li>
		<a href="#3" onMouseOut="this.style.textDecoration=''" onMouseOver="this.style.textDecoration='underline'" data-toggle="tab" style="border-radius: 15px; margin:5px;"><b>Pharmacy</b></a>
		</li>  
		<li>
		<a href="#4" onMouseOut="this.style.textDecoration=''" onMouseOver="this.style.textDecoration='underline'" data-toggle="tab" style="border-radius: 15px; margin:5px;"><b>Services</b></a>
		</li>
		<li>
		<a href="#5" onMouseOut="this.style.textDecoration=''" onMouseOver="this.style.textDecoration='underline'" data-toggle="tab" style="border-radius: 15px; margin:5px;"><b>Order Package MCU</b></a>
		</li>		
		</ul>
		</div>
		<div class="tabbable">
		<div class="tab-content">
		<div class="tab-pane" id="1">        
		<!-- block -->
		<div class="block-content collapse in" style="overflow-x: hidden;overflow-y: auto;padding-bottom: 50px;">						
		<script language="javascript">
        function addRow_lab(tableID){
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			
            //var cell1 		= row.insertCell(0);
            //var element1 	= document.createElement("input");
            //element1.type 	= "checkbox";
            //element1.name	= "chkbox[]";
            //cell1.appendChild(element1);

            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 50){
				document.getElementById('plus').disabled = true;
			}

            var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<input type='text' placeholder='start typing here. . .' onclick='if(this.value!=\"\") this.value=\"\";' onblur='javascript:if(this.value==\"\"){this.value=this.value;}' style='width: 550px;font-style: oblique;' class='span6' id='typeahead' name='lab_"+cell2.innerHTML+"' data-provide='typeahead' data-items='8' data-source='[";
        }
		
		function deleteRow_lab(tableID) {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;	
			table.deleteRow(rowCount -1);
		}
		</script>
		<INPUT class="btn btn-success" type="button" value="Add" onclick="addRow_lab('example4')" id="plus"/>
		<INPUT class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow_lab('example4');"/>
		</br>
		</br>
		<table class="table table-striped table-bordered" id="example4">
		    <thead>
            <tr>
				<th>No</th>
				<th>Lab Services</th>
			</tr>
			</thead>
			<tbody>
			<tr class="odd gradeX" id="voucher_">
				<TD>1</TD>
				<TD><input type="text" placeholder="start typing here. . ." onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" style="width: 550px;font-style: oblique;" class="span6" id="typeahead" name="lab_1" data-provide="typeahead" data-items="8" data-source='[<?php foreach($lab_item->result() as $row){ echo '"'.$row->order_id.":".$row->id_service.":[ITEM] ".$row->serv_name.'",'; }?>""]' autocomplete="off"></TD>
				<input name="rowC" value="1" type="hidden">
			</tr>
			</tbody>
		</table>		
		</div>
		</div>
		
		<div class="tab-pane" id="2">        
		<!-- block -->
		<div class="block-content collapse in" style=" overflow-x: hidden;overflow-y: auto;padding-bottom: 50px;">						
		<script language="javascript">
        function addRow(tableID){
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			
            //var cell1 		= row.insertCell(0);
            //var element1 	= document.createElement("input");
            //element1.type 	= "checkbox";
            //element1.name	= "chkbox[]";
            //cell1.appendChild(element1);

            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 50) {
				document.getElementById('plus').disabled = true;
			}

            var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<input type='text' placeholder='start typing here. . .' onclick='if(this.value!=\"\") this.value=\"\";' onblur='javascript:if(this.value==\"\"){this.value=this.value;}' style='width: 550px;font-style: oblique;' class='span6' id='typeahead' name='rad_"+cell2.innerHTML+"' data-provide='typeahead' data-items='8' data-source='[<?php foreach($rad_item->result() as $row){ echo '\"'.$row->order_id.":".$row->id_service.":[ITEM] ".$row->serv_name.'\",'; }?> \"\"]\' autocomplete='off'><input type='hidden' name='rowC_rad' value='"+cell2.innerHTML+"'>";
        }
		
/* 		function deleteRow(tableID){
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked){
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
            }catch(e) {
                alert(e);
            }
        } */
		
		function deleteRow(tableID) {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;	
			table.deleteRow(rowCount -1);
		}
		</script>
		<INPUT class="btn btn-success" type="button" value="Add" onclick="addRow('example5')" id="plus"/>
		<INPUT class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow('example5');"/>
		</br>
		</br>
		<?php
		foreach($rad_item->result() as $row){}
		?>
		<table class="table table-striped table-bordered" id="example5">
		    <thead>
            <tr>
				<th>No</th>
				<th>Radiology Services</th>
			</tr>
			</thead>
			<tbody>
			<tr class="odd gradeX" id="voucher_">
				<TD>1</TD>
				<TD><input type="text" placeholder="start typing here. . ." onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" style="width: 550px;font-style: oblique;" class="span6" id="typeahead" name="rad_1" data-provide="typeahead" data-items="8" data-source='[<?php foreach($rad_item->result() as $row){ echo '"'.$row->order_id.":".$row->id_service.":[ITEM] ".$row->serv_name.'",'; }?>""]' autocomplete="off"></TD>
				<input name="rowC_rad" value="1" type="hidden">
			</tr>
			</tbody>
		</table>		
		</div>
		</div>  
		<div class="tab-pane" id="3">        
		<!-- block -->
		<script>
	  function showDiv2(val){
		var spl =document.getElementById('id'+val+'').value;
		//alert(spl);
			if(spl != 0){
				//alert(val);
				//document.getElementById('popi'+val+'').disabled 			= true;				
			}else{
				//document.getElementById('popi'+val+'').disabled 			= false;
			}
		}
		
	  function manufacture(id){

		var resep		= document.getElementById('id'+id+'');
		var x 			= document.getElementById('gembok('+id+')');
		var gembok 		= document.getElementById('gembok('+id+')').value;
		
		var y 			= document.getElementById('idxx['+id+']');
		var kunci 		= document.getElementById('idxx['+id+']').value;
		
		//alert(gembok);
		if (gembok == "no") {
			//document.getElementById('id'+id+'').disabled 	= false;
			x.value	="no";
			
		};

		if (gembok == "yes") {
			//document.getElementById('id'+id+'').disabled 	= true;
			x.value	="yes";
			
			};
		if(kunci == "ok"){
			document.getElementById('id'+id+'').disabled 	= false;
			y.value ="ko";
		}else{
			document.getElementById('id'+id+'').disabled 	= true;
			y.value ="ok";
		};

      var dosage          = document.getElementById('b'+id+'');
      var id_drug_dosage  = document.getElementById('id_drug_dosage['+id+']');
    
      dosage.value              = ""; 
      id_drug_dosage.value      = "";                           
	  }
	  
	  function undisableTxt(){
		<?php
			$x = 1; 
			while($x <= 13) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
	  }
	  
	  function popup_s(b_id){
        window.open("<?php echo base_url();?>Pharmacy/find_item_drug/"+b_id+"","Popup","height=450, width=980, top=150, left=220");
      }
      function popup_r(b_id){
      	var id_item 	= document.getElementById('id_item['+b_id+']').value;
		var nama		= document.getElementById('a'+b_id+'').value;
		var hasil		= nama.replace("(","").replace(")","");
        window.open("<?php echo base_url();?>Pharmacy/find_dosage/"+b_id+"/"+id_item+":"+hasil+"","Popup","height=550, width=790, top=70, left=180 ");
      }
      function popup_s1(id){
			var myWindow = window.open("<?php echo base_url();?>Pharmacy/find_patient_data", "", "width=850, height=500, top=70, left=80");
	  }
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script language="javascript">
        function addRowPhar(tableID) {
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			
            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			var kurang 		= cell2.innerHTML-1;
			var gembok 		= document.getElementById('gembok('+kurang+')').value;
			var resep 		= document.getElementById('id'+kurang+'').value;
            var loop		= "<?php $b = 0; while($b <=  10 ) { echo '<option value='.$b.'>'.$b.'</option>'; $b++; } ?>";
			var gokill		= "mambo_"+cell2.innerHTML+"";
			var maknyus		= "";
    

            if (gembok == "no") {
            	var loop	= "<option value="+resep+">"+resep+"</option><?php $b = 0; while($b <=  10 ) { if($b==0){echo '<option value='.$b.'>'.$b.'</option>'; $b++; }else{echo '<option value='.$b.'>'.$b.' [Racikan]</option>'; $b++; } } ?>";	
				
				if(resep!=0){
				var maknyus	= "error";
				}else{
				var maknyus	= "";
				}
            }else{
				var loop	= "<?php $c = 0; while($c <=  10 ) { echo '<option value='.$c.'>'.$c.'</option>'; $c++; } ?>";
				var maknyus	= "";

			};
						
			if (rowCount >= 15) {
				document.getElementById('plus').disabled = true;
			}

			// alert(window.location.hash)
            var cell3 		= row.insertCell(1);
			row.setAttribute("id", gokill);
			row.setAttribute("class", maknyus);
			cell3.innerHTML = "<div id='divisi_"+cell2.innerHTML+"'></div><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'><tr><td><select id='id"+cell2.innerHTML+"' onchange='showDiv(this.value, "+cell2.innerHTML+")' style='width:45px' disabled>"+loop+"</select></td><td><input class='tgl tgl-ios' id='cbx_"+cell2.innerHTML+"' onclick='manufacture("+cell2.innerHTML+");' type='checkbox' name='opsi_"+cell2.innerHTML+"' style='display:none;'><label class='tgl-btn' for='cbx_"+cell2.innerHTML+"'></label></td><td><input type='hidden' name='resep["+cell2.innerHTML+"]' id='idx_"+cell2.innerHTML+"'> <input type='text' id='a"+cell2.innerHTML+"' name='item["+cell2.innerHTML+"]' placeholder='Drugs' style='width:185px' readonly> <button id='pop"+cell2.innerHTML+"' type='button' onclick='popup_s("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button></td></tr></table><div id='divisi_"+cell2.innerHTML+"'></div><input type='hidden' value='no' nama='gembok("+cell2.innerHTML+")' id='gembok("+cell2.innerHTML+")'> <INPUT type='hidden' id='id_item["+cell2.innerHTML+"]' name='id_item["+cell2.innerHTML+"]'/><INPUT type='hidden' name='id_base["+cell2.innerHTML+"]'/><INPUT type='hidden' value='ok' id='idxx["+cell2.innerHTML+"]'/>";

			var cell4 		= row.insertCell(2);
			cell4.innerHTML = "<div id='divisidua_"+cell2.innerHTML+"'></div><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'><tr><td><INPUT type='text' name='dosage["+cell2.innerHTML+"]' style='width:145px' placeholder='Dosage' id='b"+cell2.innerHTML+"' readonly/> <button type='button' onclick='popup_r("+cell2.innerHTML+");' id='popi"+cell2.innerHTML+"' onmouseover='showDiv2("+cell2.innerHTML+")' class='btn btn-success btn-mini'><i class='icon-search'></i></button></td><td style='width:315px;'><div style='float:right;'><div id='divisix_"+cell2.innerHTML+"'><INPUT id='bagi["+cell2.innerHTML+"]' name='bagi["+cell2.innerHTML+"]' step='any' style='width:45px' value='0' type='text' /> <b>Dosage</b> <INPUT id='hasil["+cell2.innerHTML+"]' name='hasil["+cell2.innerHTML+"]' step='any' onkeyup='pengamen("+cell2.innerHTML+");' style='width:45px' value='0' type='text' /> <input class='input-xlarge-in focused' type='text' id='unitx["+cell2.innerHTML+"]' name='unitx["+cell2.innerHTML+"]' style='width:45px; text-align:right;' type='text' disabled></div></div></td></tr></table><INPUT type='hidden' id='id_drug_dosage["+cell2.innerHTML+"]'  name='id_drug_dosage["+cell2.innerHTML+"]'  value='0'/>";

			var cell5 		= row.insertCell(3);
			cell5.innerHTML = "<div id='divisitiga_"+cell2.innerHTML+"'></div><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'><tr><td><input type='text' onkeyup='changes("+cell2.innerHTML+");' name='qty["+cell2.innerHTML+"]' value='0' id='qty["+cell2.innerHTML+"]' style='width:45px'> <input class='input-xlarge-in focused' type='text' id='unit["+cell2.innerHTML+"]' name='unit["+cell2.innerHTML+"]' style='width:45px; text-align:right;' type='text' disabled></td></tr></table>";

			if(resep!=0){
				document.getElementById("divisix_"+cell2.innerHTML+"").style.display 	= "";
			}else{
				document.getElementById("divisix_"+cell2.innerHTML+"").style.display 	= "none";	
			}
			
			var giant 		= document.getElementById('gembok('+cell2.innerHTML+')');
            if (gembok == "yes") {
            	giant.value	= "yes";	
            };

      var dosis           = document.getElementById('b'+kurang+'');
      var dosage          = document.getElementById('b'+cell2.innerHTML+'');
      var id_drug         = document.getElementById('id_drug_dosage['+kurang+']');
      var id_drug_dosage  = document.getElementById('id_drug_dosage['+cell2.innerHTML+']');
      var idxx            = document.getElementById('idxx['+kurang+']');

      if (gembok == "no") {
        dosage.value              = dosis.value; 
        id_drug_dosage.value      = id_drug.value; 
			
		}	
			var idx = document.getElementById("idx_"+cell2.innerHTML+"");
			var idy = document.getElementById("id"+cell2.innerHTML+"").value;
			idx.value = idy;
        }
 
        function deleteRowPhar(tableID){
          	var table = document.getElementById(tableID);
			var rowCount = table.rows.length;	
			table.deleteRow(rowCount -1);
        }
	
		function showDiv(elem, val){
		var spl = elem.split(":"),
		low 	= spl[0];
		
			if(low != 0){
				//alert(val);
				document.getElementById("divisi_"+val+"").innerHTML 		= "<span class='label label-important'>Manufacture Drugs - Group ["+low+"]</span><br><br>";
				document.getElementById("divisidua_"+val+"").innerHTML	 	= "<br><br>";
				document.getElementById("mambo_"+val+"").setAttribute("class", "error"); 
				document.getElementById("divisitiga_"+val+"").innerHTML 	= "<br><br>";
				document.getElementById("divisix_"+val+"").style.display 	= "";
				//document.getElementById('popi'+val+'').disabled 			= true;				
			}else{
				document.getElementById("divisi_"+val+"").innerHTML 		= "";
				document.getElementById("divisidua_"+val+"").innerHTML 		= "";
				document.getElementById("divisitiga_"+val+"").innerHTML 	= "";
				document.getElementById("divisix_"+val+"").style.display 	= "none";
				//document.getElementById('popi'+val+'').disabled 			= false;
				document.getElementById("mambo_"+val+"").setAttribute("class", ""); 
			}
			var idx = document.getElementById("idx_"+val+"");
			idx.value = low;
		}
    </script>
		<div class="block-content collapse in" style=" overflow-x: hidden;overflow-y: auto;padding-bottom: 50px;">	
			<INPUT class="btn btn-success" type="button" value="Add" onclick="addRowPhar('example6')" id="plus" />
			<INPUT class="btn btn-danger" type="button" value="Delete" onclick="deleteRowPhar('example6')" />			
			</br>
			</br>		
			<div style="width:100%; height:100%	; overflow: auto; float:center;">
			<table class="table table-hover" id="example6">
			    <thead>
              	<tr>
					<th>No</th>
					<th>Name of Drug</th>
					<th>Dosage</th>
					<th>Qty</th>
				</tr>
				</thead>
				<tbody>
				<script>
				function pengamen(b_id){    
          var unit     = document.getElementById('unit['+b_id+']');
          var unitx     = document.getElementById('unitx['+b_id+']');
          var input     = document.getElementById('bagi['+b_id+']').value;
          var nganu     = document.getElementById('hasil['+b_id+']').value;
          var res     = input.split("/");
          var hasil     = res[0]/res[1]*nganu;
          var result    = document.getElementById('qty['+b_id+']');
        
          result.value  = Math.ceil(hasil);
          unitx.value   = unit.value;
				}
				
				function changes(val){
					var x = document.getElementById("bagi["+val+"]");
					var y = document.getElementById("hasil["+val+"]");
					var xx= document.getElementById("bagi["+val+"]").value;
					var yy= document.getElementById("hasil["+val+"]").value;
					//alert(xx);
				if(xx == "0" && yy == "0"){
						return false; 
					}else{
					
					if (window.confirm('Are you sure, want Reset Dosage ?')) {
						x.value="0";
						y.value="0";
					}else{
			        	return false; 	
			        }	
					}
				}
				</script>
				<tr id='mambo_1'>
					<td>1</td>
					<td>
					<div id="divisi_1"></div>
						<table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
							<tr>
								<td><select id="id1" onchange="showDiv(this.value, 1)" style="width:45px" disabled>
								<option value=0>0</option>
								<?php
								$b = 1; 
								while($b <= 1 ) {
								echo "<option value=".$b.">".$b." [Racikan]</option>";
								$b++;
								}
								?>
								</select></td>
								<td><input class='tgl tgl-ios' id='cbx_1' onmouseover="showDiv2(1)" onclick="manufacture(1)" type='checkbox' name='opsi_1' style='display:none;'>
									<label class='tgl-btn' for='cbx_1'></label></td>
								<td><INPUT type="text" name="item[1]" style="width:185px" placeholder="Drugs" id="a1" readonly/> <button onmouseover="showDiv2(1)" id="pop1" type="button" onclick="popup_s(1);" class="btn btn-success btn-mini"><i class="icon-search"></i></button></td>
								<td></td>
							</tr>
						</table>
						
						<input type="hidden" value="no" nama="gembok(1)" id="gembok(1)">
						<!--
						<input type="text" value="0" nama="nilai(1)" id="nilai(1)">
						<span class="label label-info">
						<a href="#1" style="color: white;" onmouseover="showDiv2(1)" onclick="manufacture(1)">Prescription ?</a>
						</span>
						-->
						<input type="hidden" value="0" name="resep[1]" id="idx_1">			
						<INPUT type="hidden" name="id_item[1]" value="0" id="id_item[1]"/> 
						<INPUT type="hidden" value="0" name="id_base[1]"/>
						<INPUT type='hidden' id='idxx[1]' value='ok'/>
					</td>
					<td valign="bottom">
					<div id="divisidua_1"></div>
					<table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
						<tr>
						<td><INPUT type="text" name="dosage[1]" style="width:145px" placeholder="Dosage" id="b1" readonly/> <button id="popi1" type="button" onclick="popup_r(1);" class="btn btn-success btn-mini"><i class="icon-search"></i></button></td>
						<td style='width:315px;'><div style="float:right;">
						<div id="divisix_1" style="display: none;">
						<INPUT id="bagi[1]" name="bagi[1]" onkeyup="pengamen(1);" style="width:45px" value="0" type="text" />
						<b>Dosage</b>
						<INPUT id="hasil[1]" name="hasil[1]" onkeyup="pengamen(1);" style="width:45px" value="0" type="text" />
						<INPUT class="input-xlarge-in focused" id="unitx[1]" name="unitx[1]" style="width:45px; text-align:right" type="text" disabled/>
						</div>
						</div>
						</td>
						</tr>
					</table>				
						<INPUT type="hidden" value="0" id="id_drug_dosage[1]" name="id_drug_dosage[1]"/> 
					</td>
					<td>
						<div id="divisitiga_1"></div>
						<table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
						<tr>
							<td><INPUT id="qty[1]" name="qty[1]" step="any" onkeyup="changes(1);"  style="width:45px" value="0" type="text" /> <INPUT class="input-xlarge-in focused" id="unit[1]" name="unit[1]" style="width:45px; text-align:right" type="text" disabled/></td>
						</tr>
						</table>
					</td>
				</tr>
				</tbody>
			</table>	
			</fieldset>  
		    </div>		
		</div>
		</div>    
		<div class="tab-pane" id="4">
		<div class="block-content collapse in" style=" overflow-x: hidden;overflow-y: auto;padding-bottom: 50px;">						
		<script language="javascript">
        function addRows(tableID){
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			

            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 50) {
				document.getElementById('plus').disabled = true;
			}

            var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<input type='text' placeholder='start typing here. . .' onclick='if(this.value!=\"\") this.value=\"\";' onblur='javascript:if(this.value==\"\"){this.value=this.value;}' style='width: 650px;font-style: oblique;' class='span6' id='typeahead' name='ser_"+cell2.innerHTML+"' data-provide='typeahead' data-items='8' data-source='[<?php foreach($others->result() as $row){ echo '\"'.$row->id_service.":".$row->id_group_serv.":[GROUP] ".$row->group_desc.":[ITEM] ".$row->serv_name.'\",'; }?> \"\"]\' autocomplete='off'><input type='hidden' name='rowC_ser' value='"+cell2.innerHTML+"'> <input type='hidden' name='qty_"+cell2.innerHTML+"' value='1' style='width: 90px;' onclick='if(this.value!=\"\") this.value=\"\";' onblur='javascript:if(this.value==\"\"){this.value=\"1\";}'>";
        }
		
		function deleteRow_other(tableID) {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;	
			table.deleteRow(rowCount -1);
		}
		</script>
		<INPUT class="btn btn-success" type="button" value="Add" onclick="addRows('example7')" id="plus"/>
		<INPUT class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow_other('example7');"/>
		</br>
		</br>
		<?php
		foreach($others->result() as $row){}
		?>
		<table class="table table-striped table-bordered" id="example7">
		    <thead>
            <tr>
				<th>No</th>
				<th>Other Services</th>
			</tr>
			</thead>
			<tbody>
			<tr class="odd gradeX" id="voucher_">
				<TD>1</TD>
				<TD><input type="text" placeholder="start typing here. . ." onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" style="width: 650px;font-style: oblique;" class="span6" id="typeahead" name="ser_1" data-provide="typeahead" data-items="20" data-source='[<?php foreach($others->result() as $row){ echo '"'.$row->id_service.":".$row->id_group_serv.":[GROUP] ".$row->group_desc.":[ITEM] ".$row->serv_name.'",'; }?>""]' autocomplete="off"></TD>
				<input name="rowC_ser" value="1" type="hidden">
				<input type="hidden" value='1' name="qty_1" onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value='1';}" style="width: 90px;">
			</tr>
			</tbody>
		</table>		
		</div>
		</div>
		
		<div class="tab-pane" id="5">
		<div class="block-content collapse in" style=" overflow-x: hidden;overflow-y: auto;padding-bottom: 50px;">						
		<script language="javascript">		
        function addRows_mcu(tableID){
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);

            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 50) {
				document.getElementById('plus').disabled = true;
			}

            var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<input type='text' placeholder='start typing here. . .' onclick='if(this.value!=\"\") this.value=\"\";' onblur='javascript:if(this.value==\"\"){this.value=this.value;}' style='width: 450px;font-style: oblique;' class='span6' id='typeahead' name='mcu_"+cell2.innerHTML+"' data-provide='typeahead' data-items='8' data-source='[<?php foreach($mcu->result() as $row){ echo '\"'.$row->id_quot.":[ITEM] ".$row->quot_name.' ['.$row->client_name.'] ['.$row->qout_id.'-'.$row->quot_revision.'] \",'; }?> \"\"]\' autocomplete='off'><input type='hidden' name='rowC_mcu' value='"+cell2.innerHTML+"'>";
        }
		
		function deleteRow_mcu(tableID) {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;	
			table.deleteRow(rowCount -1);
		}
		</script>
		<INPUT class="btn btn-success" type="button" value="Add" onclick="addRows_mcu('example8')" id="plus"/>
		<INPUT class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow_mcu('example8');"/>
		</br>
		</br>

		<table class="table table-striped table-bordered" id="example8">
		    <thead>
            <tr>
				<th>No</th>
				<th>Add Package Medical Check up</th>
			</tr>
			</thead>
			<tbody>
			<tr class="odd gradeX" id="voucher_">
				<TD>1</TD>
				<TD><input type="text" placeholder="start typing here. . ." onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" style="width: 450px;font-style: oblique;" class="span6" id="typeahead" name="mcu_1" data-provide="typeahead" data-items="8" data-source='[<?php foreach($mcu->result() as $row){ echo '"'.$row->id_quot.":[ITEM] ".$row->quot_name.' ['.$row->client_name.'] ['.$row->qout_id.'-'.$row->quot_revision.']",'; }?>""]' autocomplete="off"></TD>
				<input name="rowC_mcu" value="1" type="hidden">
			</tr>
			</tbody>
		</table>		
		</div>
		</div>
		<?php 
		function time_elapsed_string_doctor($datetime, $full = false){
    $now 		= new DateTime;
    $ago 		= new DateTime($datetime);
    $diff 		= $now->diff($ago);
    $diff->w 	= floor($diff->d / 7);
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
		 foreach($soap->result() as $show){} 
		?>
		<div class="tab-pane active" id="6">
		<script>
		function sel_s(){
			if(document.getElementById('ss').readOnly == true){
				document.getElementById('ss').readOnly = false;
			}else{
				document.getElementById('ss').readOnly = true;
			}	
		}
		
		function sel_o(){
			if(document.getElementById('oo').readOnly == true){
				document.getElementById('oo').readOnly = false;
			}else{
				document.getElementById('oo').readOnly = true;
			}
		}
		
		function sel_a(){
			if(document.getElementById('aa').readOnly == true){
				document.getElementById('aa').readOnly = false;
			}else{
				document.getElementById('aa').readOnly = true;
			}
		}
		
		function sel_p(){
			if(document.getElementById('pp').readOnly == true){
				document.getElementById('pp').readOnly = false;
			}else{
				document.getElementById('pp').readOnly = true;
			}
		}
		</script>
		<div class="block-content collapse in" style=" overflow-x: hidden;overflow-y: auto;padding-bottom: 50px;">						
		Create Date : <b><?php if($soap->num_rows() > 0){ echo $show->create_date;}?></b></br>
        Create By	: <b><?php if($soap->num_rows() > 0){ echo $show->fullname;}?></b></br>
		Last Update : <b><?php if($soap->num_rows() > 0){ echo time_elapsed_string_doctor($show->update_date);}?></b>
		<hr>
		<div class="control-group">
           <label class="control-label" for="textarea2"><b>S</b>ubject</label>
           <div class="controls">
             <textarea id="ss" class="input-xlarge textarea" <?php if($soap->num_rows() > 0){ echo "readonly"; }?> name="s" placeholder="Enter text ..." style="width: 410px; height: 100px"><?php if($soap->num_rows() > 0){ echo $show->Subject;}?></textarea> <input name="s1" onclick="sel_s()" type="checkbox">
           </div>
        </div>
		
		<div class="control-group">
           <label class="control-label" for="textarea2"><b>O</b>bject</label>
           <div class="controls">
             <textarea id="oo" class="input-xlarge textarea" name="o" <?php if($soap->num_rows() > 0){ echo "readonly"; }?> placeholder="Enter text ..." style="width: 410px; height: 100px"><?php if($soap->num_rows() > 0){ echo $show->Object;}?></textarea> <input name="o1" onclick="sel_o()" type="checkbox">
           </div>
        </div>
		
		<div class="control-group">
           <label class="control-label" for="textarea2"><b>A</b>ssessment</label>
           <div class="controls">
             <textarea id="aa" class="input-xlarge textarea" name="a" <?php if($soap->num_rows() > 0){ echo "readonly"; }?> placeholder="Enter text ..." style="width: 410px; height: 100px"><?php if($soap->num_rows() > 0){ echo $show->Assessment;}?></textarea> <input name="a1" onclick="sel_a()" type="checkbox">
           </div>
        </div>
		
		<div class="control-group">
           <label class="control-label" for="textarea2"><b>P</b>lan</label>
           <div class="controls">
             <textarea id="pp" class="input-xlarge textarea" name="p" <?php if($soap->num_rows() > 0){ echo "readonly"; }?> placeholder="Enter text ..." style="width: 410px; height: 100px"><?php if($soap->num_rows() > 0){ echo $show->Plan;}?></textarea> <input name="p1" onclick="sel_p()" type="checkbox">
           </div>
        </div>	
		
		</div>
		</div>
		
		<div class="tab-pane" id="7">        
		<!-- block -->
		<?php
		$nol =0;
		?>
		<div class="block-content collapse in" style="overflow-x: hidden;overflow-y: auto;padding-bottom: 50px;">						
		<script language="javascript">
        function addRow_gi(tableID){
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			
            //var cell1 		= row.insertCell(0);
            //var element1 	= document.createElement("input");
            //element1.type 	= "checkbox";
            //element1.name	= "chkbox[]";
            //cell1.appendChild(element1);

            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 50) {
				document.getElementById('plus').disabled = true;
			}

            var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<input type='text' placeholder='start typing here. . .' onclick='if(this.value!=\"\") this.value=\"\";' onblur='javascript:if(this.value==\"\"){this.value=this.value;}' style='width: 1050px;font-style: oblique;' class='span6' id='typeahead' name='grp_"+cell2.innerHTML+"' data-provide='typeahead' data-items='8' data-source='[<?php foreach($group_item->result() as $row){ echo '\"'.$nol.":".$row->id.":[ITEM] ".$row->name_service.'\",'; }?> \"\"]\' autocomplete='off'><input type='hidden' name='rowC_grp' value='"+cell2.innerHTML+"'>";
        }
		
		function deleteRow_gi(tableID) {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;	
			table.deleteRow(rowCount -1);
		}

		</script>
		<INPUT class="btn btn-success" type="button" value="Add" onclick="addRow_gi('example99')" id="plus"/>
		<INPUT class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow_gi('example99');"/>
		</br>
		</br>
		<table class="table table-striped table-bordered" id="example99">
		    <thead>
            <tr>
				<th>No</th>
				<th>Group Item</th>
			</tr>
			</thead>
			<tbody>
			<tr class="odd gradeX" id="voucher_">
				<TD>1</TD>
				<TD><input type="text" placeholder="start typing here. . ." onclick="if(this.value!='') this.value='';" onblur="javascript: if(this.value==''){this.value=this.value;}" style="width: 1050px;font-style: oblique;" class="span6" id="typeahead" name="grp_1" data-provide="typeahead" data-items="8" data-source='[<?php foreach($group_item->result() as $row){ echo '"'.$nol.":".$row->id.":[ITEM] ".$row->name_service.'",'; }?>""]' autocomplete="off"></TD>
				<input name="rowC_grp" value="1" type="hidden">
			</tr>
			</tbody>
		</table>		
		</div>
		</div>
		
		</div>
		</div>
		
		</div>
		</div>	
		</div>
		</div>
		<div class="span12">
		<div id="myAlert" class="modal hide">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">&times;</button>
				<h5>Alert!</h5>
			</div>
			<div class="modal-body">
				<p>Are you sure ? [close] button to check again...</p>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-success" value="Save">
				<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
			</div>
		</div>
		</div>
		<div class="form-actions">
		<div style="float:left;">
			<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
		</div>
		<div style="float:right;">
			<button type="reset" class="btn btn-danger"><b>Reset</b></button>
		</div>
		</div>
		</form>
		</body>