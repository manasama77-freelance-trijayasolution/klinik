		<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
		<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
		<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
		<script src="<?php echo base_url();?>design/vendors/jGrowl/jquery.jgrowl.js"></script>
		<link href="<?php echo base_url();?>design/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen">
	<?php
		$id						= $this->uri->segment(3);
		$idx					= $this->uri->segment(4);
		$session_data 			= $this->session->userdata('logged_in');
		$userlvl				= $session_data['userlevel'];
		if($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Input Master Package
		</div>
	<?php
		}elseif($id=="change"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Update Data Master Services
	    </div>
	<?php
		}elseif($id=="del"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Delete Master Services
		</div>
	<?php
		}

	?>	
	<script>
	  function undisableTxt(){
		<?php
			$x = 0; 
			while($x <= 2) {
			echo "document.getElementById('".$x."').disabled = false;";
			$x++;
			}	
		?>
		document.getElementById("plus").disabled = false;
		document.getElementById("save").disabled = false;
		document.getElementById("negatif").disabled = false;
		document.getElementById("group_1").disabled = false;
		document.getElementById("locked").style.display = "";
		document.getElementById("lock").style.display = "none";
	  }
	  
	  function goBack(){
	  	window.history.back();
	  }
	  
	  function tiru(){
		var xx = document.getElementById("clien");
		var yy = document.getElementById("comment");
		
		yy.value = xx.value;
	  }
	  
	  function popup(id){
		var idx = document.getElementById('group_'+id).value;
        window.open("<?php echo base_url();?>marketing/find_services_quot/"+id+"/"+idx+"","Popup","height=550, width=980, top=70, left=180 ");
			
			var table 		= document.getElementById('exampl2');
            var rowCount 	= table.rows.length-1;
			var i;
			var text 		= "";
			//alert(rowCount); ///LOOPING PAKE TO	
			for (i = 1; i <= rowCount; i++) { 
				text += document.getElementById('fulus['+i+']').value.replace(",|.","")-1;
				text++;
				//text += parseFloat(text);
			}
			var result 		= document.getElementById('grand');
			result.value 	= accounting.formatMoney(text);
		
      }
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
		<script>
			function getComboA(sel) {
				var value = sel;  
				document.getElementById('service['+sel+']').readOnly = false;
				document.getElementById('total['+sel+']').readOnly = false;
				document.getElementById('pop'+sel+'').disabled = true;
				document.getElementById('id_service['+sel+']').value = "0";
				document.getElementById('service['+sel+']').value = "";
				document.getElementById('total['+sel+']').value = "";
				document.getElementById('fulus['+sel+']').value = "";
				$('#cbx_'+sel+'').click(function(){
					if (this.checked) {	
						document.getElementById('service['+sel+']').value = "";
						document.getElementById('service['+sel+']').readOnly = false;
						document.getElementById('id_service['+sel+']').value = "0";
						document.getElementById('total['+sel+']').readOnly = false;
						document.getElementById('pop'+sel+'').disabled = true;
						document.getElementById('total['+sel+']').value = "";
						document.getElementById('fulus['+sel+']').value = "";
					}else{
						document.getElementById('service['+sel+']').value = "";
						document.getElementById('id_service['+sel+']').value = "0";
						document.getElementById('service['+sel+']').readOnly = true;
						document.getElementById('pop'+sel+'').disabled = false;
						document.getElementById('total['+sel+']').readOnly = true;
						document.getElementById('total['+sel+']').value = "";
						document.getElementById('fulus['+sel+']').value = "";
					}
				}) 
			}
		</script>
	<?php
	function romanic_number($integer, $upcase = true) 
	{ 
		$table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
		$return = ''; 
		while($integer > 0) 
		{ 
			foreach($table as $rom=>$arb) 
			{ 
				if($integer >= $arb) 
				{ 
					$integer -= $arb; 
					$return .= $rom; 
					break; 
				} 
			} 
		} 
		return $return; 
	} 
	?>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script type="text/javascript">
	function setBlurFocus(id) {
				var user_input = accounting.formatMoney(document.getElementById('total['+id+']').value);
			document.getElementById('total['+id+']').value = user_input;
			}
	function setBlurFocus2() {
				var user_input = accounting.formatMoney(document.getElementById('adjs_amt').value);
			document.getElementById('adjs_amt').value = user_input;
			}
	function setBlurFocus3() {
				var user_input = accounting.formatMoney(document.getElementById('dixc').value);
			document.getElementById('dixc').value = user_input;
			}
	</script>
	<script language="javascript">
	function showDiv(elem, val){
	//var spl = elem.split(":"),
	low 	= elem;
	//alert(low)
	
	
		if(low == 0 || low == 3){
			document.getElementById('cc'+val+'').style.display = "";
		}else{
			document.getElementById('cc'+val+'').style.display = "none";
		}
		
		if(low == 1){
			//document.getElementById('aa'+val+'').style.display = "";
			//document.getElementById('dd'+val+'').style.display = "";
		}else{
			//document.getElementById('dd'+val+'').style.display = "none";
			//document.getElementById('aa'+val+'').style.display = "none";
		}
		
		if(low == 2 || low == 6){
			//document.getElementById('bb'+val+'').style.display = "";
		}else{
			//document.getElementById('bb'+val+'').style.display = "none";
		}
		
		if(low == 4){
			document.getElementById('cby_'+val+'').style.display = "";
			document.getElementById('tax_'+val+'').style.display = "";
		}else{
			document.getElementById('cby_'+val+'').style.display = "none";
			document.getElementById('tax_'+val+'').style.display = "none";
		}
	}
	
	function showDiv2(){		
		for	(var val = 1; val <= <?=$jml;?>; val++){
			
			low 	= document.getElementById('group_'+val+'').value;
			
			
			if(low == 0 || low == 3){
				document.getElementById('cc'+val+'').style.display = "";
			}else{
				document.getElementById('cc'+val+'').style.display = "none";
			}
			
			if(low == 1){
				//document.getElementById('aa'+val+'').style.display = "";
				//document.getElementById('dd'+val+'').style.display = "";
			}else{
				//document.getElementById('dd'+val+'').style.display = "none";
				//document.getElementById('aa'+val+'').style.display = "none";
			}
			
			if(low == 2 || low == 6){
				//document.getElementById('bb'+val+'').style.display = "";
			}else{
				//document.getElementById('bb'+val+'').style.display = "none";
			}
			
			if(low == 4){
				document.getElementById('cby_'+val+'').style.display = "";
				document.getElementById('tax_'+val+'').style.display = "";
			}else{
				document.getElementById('cby_'+val+'').style.display = "none";
				document.getElementById('tax_'+val+'').style.display = "none";
			}
		}
	}
			
	function areyou(id) {
		var r = confirm("Are You Sure ? You will lose some of the data updated below.");
		if (r == true) {
		x = window.location = "<?php echo base_url();?>marketing/remove_list/"+id+"/"+<?=$id;?>;
		} else {
		x = alert("Be calm, You pressed cancel");
		}
	}
		
    function addRow(tableID) {
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			row.className 	= "info";
            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 50) {
				document.getElementById('plus').disabled = true;
			}
			
			var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<table style='border-radius:10px; overflow: auto; border: 0px solid #282929; top: 100px;'><tr><td><select onchange='showDiv(this.value, "+cell2.innerHTML+");' name='g_change[]' id='group_"+cell2.innerHTML+"' style='width: 190px;' required><option value=''>- Choose Group -</option><?php foreach($sv_group->result() as $rows){	?><option value='<?=$rows->id_serv_group?>' align='justify'><?=$rows->group_desc?></option><?php }	?></select></td></tr><tr><td><select id='aa"+cell2.innerHTML+"' name='one[]' style='width: 190px; display:none;'><option value=''>- Choose -</option><?php foreach($sv_lab->result() as $rows){?><option value='<?=$rows->id_lab_item_group?>' align='justify'><?=$rows->group_name?></option><?php	}?>	</select><select id='bb"+cell2.innerHTML+"' name='two[]' style='width: 190px; display:none;'><option value=''>- Choose -</option><?php foreach($sv_rad->result() as $rows){	?><option value='<?=$rows->id_rad_group?>' align='justify'><?=$rows->group_desc?></option><?php	}?></select><select name='three[]' id='cc"+cell2.innerHTML+"'  style='width: 190px; display:none;'><option value=''>- Choose Group Exam. -</option><option value='Anthropometry' align='justify'>Anthropometry</option><option value='Eyes test' align='justify'>Eyes test</option><option value='Hearing' align='justify'>Hearing</option><option value='Blood Pressure' align='justify'>Blood Pressure</option><option value='Respiratory system' align='justify'>Respiratory system</option></select></td></tr></table>";

            var cell3 		= row.insertCell(2);
			cell3.innerHTML = "<table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'><tr><td><input type='text' id='service["+cell2.innerHTML+"]' name='service[]' placeholder='Service item' style='width:285px' readonly> <button id='pop"+cell2.innerHTML+"' type='button' onclick='popup("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button> <hr><textarea id='notes_services["+cell2.innerHTML+"]' name='notes_services[]'></textarea> <b><i>* (optional) notes for this item.</i></b> </td><td id='cby_"+cell2.innerHTML+"' style='display:none;'><input class='tgl tgl-ios' id='cbx_"+cell2.innerHTML+"'  onclick='getComboA("+cell2.innerHTML+");' type='checkbox' name='opsi[]' style='display:none;'><label class='tgl-btn' for='cbx_"+cell2.innerHTML+"'></label><b>Other</b></td></tr></table><input value='0' name='id_service[]' id='id_service["+cell2.innerHTML+"]' type='hidden'> <hr><div id='tax_"+cell2.innerHTML+"' style='display:none;'><input type='radio'  onclick='tax2("+cell2.innerHTML+");' name='cki"+cell2.innerHTML+"' id='ck_"+cell2.innerHTML+"' value='2' style='width:15px; height:15px;'><b>Tax 2% - </b> <input name='cki"+cell2.innerHTML+"' type='radio' onclick='tax6("+cell2.innerHTML+");' value='6' id='ck_"+cell2.innerHTML+"' style='width:15px; height:15px;'><b>Tax 6% </b></div>";
 
 
			var cell4 		= row.insertCell(3);
			cell4.innerHTML = "<div align='right'><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'><tr><td><input class='input-xlarge-i' id='total["+cell2.innerHTML+"]' name='price[]' value='0' onchange='setBlurFocus("+cell2.innerHTML+");' style='width:145px; text-align:right;' type='text'></br><div id='notif_"+cell2.innerHTML+"' style='display:none; float:right;'><font size='2mm'><i>after tax. </i></font></div></br><hr><div id='penutup_"+cell2.innerHTML+"' style='display:none;'><font size='2mm'><i>before tax. </i><span style='float:right;' id='before_"+cell2.innerHTML+"'></span></font></br><font size='2mm'><i>tax. </i><span style='float:right;' id='taxi_"+cell2.innerHTML+"'></span></font></div><input type='hidden' id='bf_t_"+cell2.innerHTML+"' value='' name='bf[]'> <input type='hidden' name='rowcount' value='"+cell2.innerHTML+"'><input type='hidden' id='seq["+cell2.innerHTML+"]' name='seq[]'><input type='hidden' name='id[]'><input type='hidden' name='fulus[]' id='fulus["+cell2.innerHTML+"]'><input type='hidden' name='orderid[]' id='orderid["+cell2.innerHTML+"]'><input type='hidden' name='orderty[]' id='orderty["+cell2.innerHTML+"]'><input type='hidden' name='group[]' id='group["+cell2.innerHTML+"]'></td></tr></table></div>";
        }

		function loadgrandtotal(tableID){
			var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length-1;
			var i;
			var text 		= "";
			//alert(rowCount); ///LOOPING PAKE TO	
			for (i = 1; i <= rowCount; i++) { 
			
			
			var total 		= document.getElementById('total['+i+']');
			var fulus 		= document.getElementById('fulus['+i+']');

			fulus.value		= total.value.replace(",","").replace(",","").replace(",","").replace(",","")

				text += document.getElementById('total['+i+']').value.replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","")-1;
				text++;
				//text += parseFloat(text);
			}
			var adjs_baru			= document.getElementById('adjs_amt').value.replace(",",""); 	
			var result 				= document.getElementById('grand');
			// var baby 				= document.getElementById('grand').value.replace(",","");
			var result_2			= document.getElementById('grandma');
			var adjs 				= document.getElementById('adjs').value;
			var adjs_a 				= document.getElementById('adjs_amt');
			result.value 			= accounting.formatMoney(text);
			result_2.value 			= text;
			
			var goblin				= text * (adjs/100);
			//console.log(text);
			//adjs_a.value			= accounting.formatMoney(text * adjs/100);
			var glendotan			= document.getElementById('peka');
			glendotan.value 		= accounting.formatMoney(parseInt(result.value.replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt(adjs_baru.replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","")));
			//console.debug(result_2.value)
		}
		
		function loadgrandtotal2(tableID){
			var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length-1;
			var i;
			var text 		= 0;

			//alert(rowCount); ///LOOPING PAKE TO	
			for (i = 1; i <= rowCount; i++) { 

			var total 		= document.getElementById('total['+i+']');
			var fulus 		= document.getElementById('fulus['+i+']');

			fulus.value		= total.value.replace(",","").replace(",","").replace(",","").replace(",","")


			if (document.getElementById('id_service['+i+']').value==0){
				text += document.getElementById('fulus['+i+']').value.replace(",","")-1;
				//console.log("a");
				
			}else{
				text += document.getElementById('fulus['+i+']').value.replace(",","")-1;
				//console.log("b");
			}
			//console.log(text);
				text++;
				//text += parseFloat(text);
			}
			
			var adjs_baru			= document.getElementById('adjs_amt').value.replace(",",""); 	
			var result 				= document.getElementById('grand');
			// var baby 				= document.getElementById('grand').value.replace(",","");
			var result_2			= document.getElementById('grandma');
			var adjs 				= document.getElementById('adjs');
			var adjs_a 				= document.getElementById('adjs_amt').value.replace(",","").replace(",","");
			var disc_3				= document.getElementById('adjs');
			//console.log(adjs_a);
			//adjs.value				= accounting.formatMoney(text * adjs/100);
			var glendotan			= document.getElementById('peka');
			glendotan.value 		= accounting.formatMoney(parseInt(text) + parseInt(adjs_a));
			var glendotanx			= glendotan.value.replace(",","").replace(",","");
			// console.log(glendotanx);
			//adjs.value				= text * (adjs/100);
			//alert(result.value);

			disc_3.value  			= Math.round(parseInt(adjs_a)/parseInt(glendotan.value.replace(",","").replace(",",""))*100);
			// disc_3.value  			= Math.round(parseInt(adjs_a)/parseInt(glendotanx)*100);
			
			var goblin				= text * (adjs/100);
	
			//console.debug(result_2.value)
		}
		
		function loadgrandtotal3(){
			var grand		= document.getElementById("grand").value.replace(",","").replace(",","");
			var margin1		= document.getElementById("adjs");
			var margin2		= document.getElementById("adjs_amt");
			var sell 		= document.getElementById("peka").value.replace(",","").replace(",","");
			var cost 		= document.getElementById("grand").value.replace(",","").replace(",","");

			margin2.value	= accounting.formatMoney(sell - cost);
			margin1.value 	= Math.round(parseInt(margin2.value.replace(",","").replace(",",""))/parseInt(grand)*100);
			// margin1.value 	= Math.round(parseInt(margin2.value)/parseInt(sell)*100);
		}

		
		function tax2(id){
			var result			= document.getElementById("fulus["+id+"]").value;
			var hasil			= result * (2/100)
			var lagi			= result - hasil
			document.getElementById("penutup_"+id+"").style.display = "";
			document.getElementById("notif_"+id+"").style.display 	= "";
			document.getElementById("before_"+id+"").innerHTML 		= accounting.formatMoney(document.getElementById("fulus["+id+"]").value);
			document.getElementById("bf_t_"+id+"").value	 		= document.getElementById("fulus["+id+"]").value;
			document.getElementById("taxi_"+id+"").innerHTML 		= accounting.formatMoney(hasil);
			document.getElementById("total["+id+"]").value  		= accounting.formatMoney(lagi);
			// document.getElementById("total["+id+"]").value = lagi;
			document.getElementById("fulus["+id+"]").value 			= lagi;
		}
		
		function tax6(id){
			var result			= document.getElementById("fulus["+id+"]").value;

			var hasil			= result * (6/100)
			var lagi			= result - hasil
			
			document.getElementById("penutup_"+id+"").style.display = "";
			document.getElementById("notif_"+id+"").style.display 	= "";
			document.getElementById("before_"+id+"").innerHTML 		= accounting.formatMoney(document.getElementById("fulus["+id+"]").value);
			document.getElementById("bf_t_"+id+"").value	 		= document.getElementById("fulus["+id+"]").value;
			document.getElementById("taxi_"+id+"").innerHTML 		= accounting.formatMoney(hasil);
			document.getElementById("total["+id+"]").value  		= accounting.formatMoney(lagi);
			// document.getElementById("total["+id+"]").value = lagi;
			document.getElementById("fulus["+id+"]").value 			= lagi;
			//alert(hasil);
		}
		
		function undisableTxt2(b_id){
			if(document.getElementById('service['+b_id+']').readOnly == true){
			document.getElementById('service['+b_id+']').readOnly = false;
			}else{
			document.getElementById('service['+b_id+']').readOnly = true;
			}
		}
		
		function undisableTxt1(){
			document.getElementById('f').readOnly = false;
		}
 
        function deleteRow(tableID){
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length-1;	
			//alert(rowCount);
			//alert(<?=$jml;?>);
			if (rowCount == <?=$jml;?>) {
			alert('Can\'t Delete this row, Delete row with icon trash!');
			}else{
			table.deleteRow(rowCount+1-1);	
			}
			
        }

		function deleteRow(tableID){
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length-1;	
			//alert(rowCount);
			//alert(<?=$jml;?>);
			if (rowCount == <?=$jml;?>) {
			alert('Can\'t Delete this row, Delete row with icon trash!');
			}else{
			table.deleteRow(rowCount+1-1);	
			}
			
        }
    </script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script type="text/javascript">
	function setBlurFocus(id) {
		var user_input = accounting.formatMoney(document.getElementById(id+'b').value);
		document.getElementById(id+'b').value = user_input;
	}
	</script>
	<script src="<?php echo base_url();?>design/assets/acc.js"></script>
	<script type="text/javascript">
	function setBlurFocus(id) {
		var user_input = accounting.formatMoney(document.getElementById('total['+id+']').value);
		document.getElementById('total['+id+']').value = user_input;
	}
	</script>
	<style>
			p.hi{
				color: black; 
				font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
				font-size: 16px;
				margin: 10px 0 0 10px;
				white-space: nowrap;
				overflow: hidden;
				width: 30em;
				animation: type 4s steps(60, end); 
			}
			p.hi:nth-child(2){
				animation: type2 8s steps(60, end);
			}	
			span.hi{
				animation: blink 1s infinite;
			}
			@keyframes type{ 
				from { width: 0; } 
			} 			
			@keyframes type2{
				0%{width: 0;}
				50%{width: 0;}
				100%{ width: 100; } 
			} 
			@keyframes blink{
				to{opacity: .0;}
			}
	</style>
	<?php
	foreach($print_h->result() as $rows){}
	?>
				<body onload="startTime(); showDiv2();">
                    <!-- morris stacked chart -->
                    <div class="row-fluid" onmouseover="loadgrandtotal('exampl2');">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>My Quotation - Update Package</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
                            <div class="block-content collapse in">         
                                      <fieldset>
										<?php
										if($idx!="edit"){
										?>
										<form class="form-horizontal" action="<?php echo base_url();?>marketing/update_quotation/<?=$id;?>" method="post" name="quotation">
										<?php
										}else{
										?>
										<form class="form-horizontal" action="<?php echo base_url();?>marketing/saved_quotation/<?=$id;?>" method="post" name="quotation">
										<?php
										}
										?>
										<!--<div id="" style="overflow-y: scroll; height:260px;">-->
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">No. Quotation</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="no_quot" type="text" autocomplete="off" value="<?=$rows->qout_id?><?php if($rows->quot_revision>=1){ echo "/Rev-".$rows->quot_revision;} ?>" readonly>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package Name</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="p_name" type="text" autocomplete="off" value="<?=$rows->quot_name?>" readonly>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Company</label>
                                          <div class="controls">
                                            <input class="input-xlarge focused" name="" type="text" autocomplete="off" value="<?=$rows->client_name?>" disabled>
											<input type="hidden" name="p_client" value="<?=$rows->client_id?>">
											<input type="hidden" name="q_r" value="<?=$rows->quot_revision?>">
											
											<input type="hidden" name="v_exp" value="<?=$rows->quot_date_valid?>">
											<input type="hidden" name="p_exp" value="<?=$rows->quot_date_end?>">
											<input type="hidden" name="n_qt" value="<?=$rows->qout_id?>">
											<input type="hidden" name="pax" value="<?=$rows->qty_estimate?>">
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package Expired</label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" name="" value="<?=date("d M Y",strtotime($rows->quot_date_end))?>" type="text"autocomplete="off" disabled> <i class="icon-calendar"></i> 
                                          </div>
                                        </div>
										<input name="idx" value="<?=$id;?>" type="hidden">
										<hr>
										<table  id="exampl2"  class="table table-hover" style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
										    <thead>
                                          	<tr>
												<th>No</th>
												<th>Group</th>
												<th>Service</th>
												<th><div align="right">Price</div></th>
											</tr>
											</thead>
											<tbody>
											<?php
											$bb		=1;	$taxi		=1; $notif	=1;
											$noaa 	=1; $pop		=1; $bft	=1;
											$nobb 	=1; $service	=1; $ck_1	=1;
											$nocc 	=1; $cbx		=1; $ck_2	=1;
											$nodd 	=1; $cby		=1;	$bftn	=1;
											$nocby 	=1; $cbz		=1; $nts	=1;
											$no		=1; $popid		=1; $as		=1;
											$total	=1; $ubahangka	=1;	$ab		=1;
											$lagi	=1;	$TAX		=1; $ac 	=1;
											$confirm=1;	$tax2		=1;	$ad 	=1;
											$zz		=1; $tax6		=1;
											$bulb	=1; $pen		=1;
											$rowc	=1;	$before		=1;
											
											foreach($print_d->result() as $rowd){
											?>
											<tr class="error">
												<TD><b><?=$no++;?></b></TD>
												<TD>
												<table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr class="info">
													<td>
													<select onchange='showDiv(this.value, <?=$lagi++;?>);' name='g_change[]' id='group_<?=$bb++;?>' style='width: 190px;' required>
													<option value=''>- Choose Group -</option>
													<?php 
													foreach($sv_group->result() as $rows){
													?>
													<option value='<?=$rows->id_serv_group?>' <?php if($rows->id_serv_group==$rowd->group_service){ echo "selected";} ?> align='justify'><?=$rows->group_desc?></option>
													<?php
													}
													?>
													</select>
													</td>
												</tr>						
												<tr class="info">
													<td>				
													<select id='cc<?=$nocc++;?>' name='three[]' style='width: 190px; display:none;'>
													<option value=''>- Choose Group Exam. -</option>
													<option <?php if ($rowd->group_header == "Anthropometry") { echo "selected"; }  ?> value='Anthropometry' align='justify'>Anthropometry</option>
													<option <?php if ($rowd->group_header == "Eyes test") { echo "selected"; }  ?> value='Eyes test' align='justify'>Eyes test</option>
													<option <?php if ($rowd->group_header == "Hearing") { echo "selected"; }  ?> value='Hearing' align='justify'>Hearing</option>
													<option <?php if ($rowd->group_header == "Blood Pressure") { echo "selected"; }  ?> value='Blood Pressure' align='justify'>Blood Pressure</option>
													<option <?php if ($rowd->group_header == "Respiratory system") { echo "selected"; }  ?> value='Respiratory system' align='justify'>Respiratory system</option>
													</select>
											
													</td>
												</tr>
												</table>	
												</TD>
												<TD>
												<table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><input type='text' value="<?=$rowd->service_other?>" name='service[]' id='service[<?=$service++;?>]' style='width:285px' placeholder='Service item' readonly autocomplete="off" required/> <button id='pop<?=$popid++;?>' type='button' onclick='popup(<?=$pop++;?>); loadgrandtotal("exampl2");' class='btn btn-success btn-mini'><i class='icon-search'></i></button> <span onclick="areyou('<?=$rowd->id_quot_detail;?>');"class="btn btn-danger btn-mini"><i class="icon-trash"></i></span> <hr> 		
													<textarea name='notes_services[]' id='notes_services[<?=$nts++;?>]'><?=$rowd->notes_service?></textarea> <b><i>* (optional) notes for this item.</i></b> <div id="tax_<?=$TAX++;?>" style="display:none;"><input type="radio" <?php if($rowd->service_tax=="2"){ echo "checked";} ?> onclick="tax2(<?=$tax2++;?>);" name="cki<?=$ck_1++;?>" id="ck_1" value="2" style="width:15px; height:15px;"><b>Tax 2% - </b> <input name="cki<?=$ck_2++;?>" type="radio" <?php if($rowd->service_tax=="6"){ echo "checked";} ?> onclick="tax6(<?=$tax6++;?>);" value="6" id="ck_1" style="width:15px; height:15px;"><b>Tax 6% </b></div></td>
													<td id="cby_<?=$nocby++;?>" style='display:none;'><input class='tgl tgl-ios' id='cbx_<?=$cbx++;?>' onclick='getComboA(<?=$cby++;?>);' type='checkbox' name='opsi[]' style='display:none;'>
													<label class='tgl-btn' for='cbx_<?=$cbz++;?>' ></label><b>Other</b>
													</td>
												</tr>
												</table>									
												</TD>
												<TD>	 
												<div align="right">
												<table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td>													
													<INPUT id="total[<?=$total++;?>]" name="price[]" value="<?=number_format($rowd->service_price,2)?>" style="width:145px; text-align:right" onmouseover="loadgrandtotal('exampl2');" onchange="setBlurFocus(<?=$ubahangka++;?>);" type="text" autocomplete="off">
													
													</br>
													<div id="notif_<?=$notif++;?>" style="display:none; float:right;"><font size="2mm"><i>after tax. </i></font></div>
													</br>
													<hr>
													<div id="penutup_<?=$pen++;?>" style="display:none;">
													<font size="2mm"><i>before tax. </i><span style="float:right;" id="before_<?=$before++;?>"></span></font>
													</br><font size="2mm"><i>tax. </i><span style="float:right;" id="taxi_<?=$taxi++;?>"></span></font>
													</div>
													<input type="hidden" id="bf_t_<?=$bft++;?>" value="<?=$rowd->before_tax?>" name="bf[]">
													<input type="hidden" name="seq[]" id="seq[<?=$as++;?>]"> 
													<input name="id_service[]" id="id_service[<?=$bulb++;?>]" value="<?=$rowd->service_id;?>" type="hidden">
													<input id="fulus[<?=$zz++;?>]" name="fulus[]" value="<?=$rowd->service_price?>" type="hidden">
													<input name="orderid[]" id="orderid[<?=$ab++;?>]" type="hidden">
													<input id="orderty[<?=$ac++;?>]" name="orderty[]" type="hidden">
													<input name="group[]" id="group[<?=$ad++;?>]" type="hidden">
													<input name="rowcount" value="<?=$rowc++;?>" type="hidden">
													</td>
												</tr>
												</table>
												</div>
												</TD>
											</tr>
											<?php
											}
											foreach($print_h->result() as $rows){}
											?>
											<textarea name="client" id="comment" style="display:none;"></textarea>					
											</tbody>
										</table>	
										<INPUT class="btn btn-success" type="button" value="Add" onclick="addRow('exampl2'); " id="plus"/>
										<INPUT class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow('exampl2'); loadgrandtotal('exampl2');"/>
										</fieldset>  
										<table class="table table-hover" style="border-radius:10px;">
										<!--
											<tr class="error">
											<td><div align="right"><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><b>Discount </b> <INPUT readonly id="dis" class="input-xlarge-in focused" name="disc_persen" value="0" style="width:45px; text-align:right" autocomplete="off" max="100" type="number"> <INPUT onkeyup="disc2('exampl2');" onchange="setBlurFocus3();" class="input-xlarge-in focused" id="dixc" name="disc_amnt" value="0" style="width:145px; text-align:right" type="text"></td>
												</tr>
												</table></div></td>
											</tr>
										-->
											<tr class="success">
											<td><div align="right"><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><b>Cost</b> <INPUT class="input-xlarge-in focused" onkeyup="loadgrandtotal('exampl2');" id="grand" name="amount_total" value="0" style="width:145px; text-align:right" type="text" readonly></td>
												</tr>
												</table></div></td>
											</tr>
											<tr class="info">
											<td><div align="right"><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><b>Margin</b> <INPUT readonly class="input-xlarge-in focused" id="adjs" name="adjs_amount" value="<?=$rows->margin?>" style="width:45px; text-align:right" autocomplete="off" max="100" type="number"> <INPUT class="input-xlarge-in focused" autocomplete="off"  id="adjs_amt" name="adjs_nominal" value="<?=number_format($rows->margin_amount,2)?>" onkeyup="loadgrandtotal2('exampl2');" style="width:145px; text-align:right" onchange="setBlurFocus2();"  type="text"><input id="grandma" type="hidden"></td>
												</tr>
												</table></div></td>
											</tr>
											<tr class="success">
											<td><div align="right"><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><b>Sell Priced</b> <INPUT class="input-xlarge-in focused" id="peka" onkeyup="loadgrandtotal3();" name="peka" value="0" style="width:145px; text-align:right" type="text"></td>
												</tr>
												</table></div></td>
											</tr>
										</table>
									    </div>
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" id="save" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										<div class="form-actions">
										<div style="float: left;">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
										</div>
										
										<div style="float:right;">
										<button class="btn btn-danger" onclick="window.close(this);" type="reset"><b>Exit</b></button> 
										</div>
                                        </div>
										<legend></legend>
										</form>        						
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
		<?php
			foreach($notes->result() as $rowa){}
			function time_elapsed_stringxxx($datetime, $full = false){
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
		
		<?php
		//echo $rows->is_finalised;
		if($rows->is_finalised != 1){
		?>
		<script>
        $(function() {
			window.mouseover = $.jGrowl("<b>Notes From <?=$rowa->fullname?></b> : </br><?=$rowa->notes?>, <?=time_elapsed_stringxxx($rowa->approved_date)?><hr>Reply Notes :<textarea id='clien' onkeyup='tiru();' placeholder='text here...'></textarea>", { sticky: true });
        });
		</script>
		<?php
		}
		?>
</body>