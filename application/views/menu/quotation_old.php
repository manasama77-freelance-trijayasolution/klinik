	<?php
		$id						= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
		$userlvl				= $session_data['userlevel'];
		if($id=="ok"){
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> Added Quotation, Check your files in <b>My Quotation</b> Menu.
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
	  
	  function popup(id){
		var idx = document.getElementById('group_'+id).value;
        window.open("<?php echo base_url();?>marketing/find_services/"+id+"/"+idx+"","Popup","height=550, width=980, top=70, left=180 ");
			
			var table 		= document.getElementById('example2');
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
				document.getElementById('a'+sel+'').readOnly = false;
				document.getElementById('total['+sel+']').readOnly = false;
				document.getElementById('pop'+sel+'').disabled = true;
						document.getElementById('fulus['+sel+']').value = 0;
						document.getElementById('total['+sel+']').value = 0;
						document.getElementById('id_service['+sel+']').value = 0;
						document.getElementById('a'+sel+'').value = "";
				$('#cbx_'+sel+'').click(function(){
					if (this.checked) {	
						document.getElementById('a'+sel+'').readOnly = false;
						document.getElementById('total['+sel+']').readOnly = false;
						document.getElementById('pop'+sel+'').disabled = true;
						document.getElementById('fulus['+sel+']').value = 0;
						document.getElementById('total['+sel+']').value = 0;
						document.getElementById('id_service['+sel+']').value = 0;
						document.getElementById('a'+sel+'').value = "";
					}else{
						document.getElementById('a'+sel+'').readOnly = true;
						document.getElementById('pop'+sel+'').disabled = false;
						document.getElementById('total['+sel+']').readOnly = true;
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
	var spl = elem.split(":"),
	low 	= spl[0];
	//alert(low)
		if(low == 0 || low == 3){
			document.getElementById('cc'+val+'').style.display = "";
		}else{
			document.getElementById('cc'+val+'').style.display = "none";
		}
		
		if(low == 1){
			document.getElementById('aa'+val+'').style.display = "";
			document.getElementById('dd'+val+'').style.display = "";
		}else{
			document.getElementById('dd'+val+'').style.display = "none";
			document.getElementById('aa'+val+'').style.display = "none";
		}
		
		if(low == 2 || low == 6){
			document.getElementById('bb'+val+'').style.display = "";
		}else{
			document.getElementById('bb'+val+'').style.display = "none";
		}
		
		if(low == 4){
			document.getElementById('cby_'+val+'').style.display = "";
			document.getElementById('tax_'+val+'').style.display = "";
		}else{
			document.getElementById('cby_'+val+'').style.display = "none";
			document.getElementById('tax_'+val+'').style.display = "none";
		}
	}
	
    function addRow(tableID) {
            var table 		= document.getElementById(tableID);
            var rowCount 	= table.rows.length;
            var row 		= table.insertRow(rowCount);
			
            var cell2 		= row.insertCell(0);
            cell2.innerHTML = rowCount + 1-1;
			
			if (rowCount >= 50) {
				document.getElementById('plus').disabled = true;
			}
			
			var cell3 		= row.insertCell(1);
			cell3.innerHTML = "<table style='border-radius:10px; overflow: auto; border: 0px solid #282929; top: 100px;'><tr><td><select onchange='showDiv(this.value, "+cell2.innerHTML+");' name='g_change_"+cell2.innerHTML+"' id='group_"+cell2.innerHTML+"' style='width: 190px;' required><option value=''>- Choose Group -</option><?php foreach($sv_group->result() as $rows){	?><option value='<?=$rows->id_serv_group?>' align='justify'><?=$rows->group_desc?></option><?php }	?></select></td></tr><tr><td><select id='aa"+cell2.innerHTML+"' name='one_"+cell2.innerHTML+"' style='width: 190px; display:none;'><option value=''>- Choose Lab Group -</option><?php foreach($sv_lab->result() as $rows){?><option value='<?=$rows->id_lab_item_group?>' align='justify'><?=$rows->group_name?></option><?php	}?>	</select><select id='bb"+cell2.innerHTML+"' name='two_"+cell2.innerHTML+"' style='width: 190px; display:none;'><option value=''>- Choose Rad. Group -</option><?php foreach($sv_rad->result() as $rows){	?><option value='<?=$rows->id_rad_group?>' align='justify'><?=$rows->group_desc?></option><?php	}?></select><INPUT placeholder='Group Examination' name='three_"+cell2.innerHTML+"'  id='cc"+cell2.innerHTML+"' style='width: 176px; text-align:left; display:none; text-transform: uppercase;' type='text' ></td></tr><tr><td><select id='dd"+cell2.innerHTML+"' name='mark_"+cell2.innerHTML+"' style='width: 190px; display:none;'><option value=''>- Choose Sampling -</option><?php foreach($sv_mark->result() as $rowa){ ?><option value='<?=$rowa->id?>' align='justify'><?=$rowa->nama_group?></option><?php } ?></select></td></tr></table>";

            var cell3 		= row.insertCell(2);
			cell3.innerHTML = "<table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'><tr><td><input type='text' id='a"+cell2.innerHTML+"' name='service["+cell2.innerHTML+"]' placeholder='Service item' style='width:285px' readonly> <button id='pop"+cell2.innerHTML+"' type='button' onclick='popup("+cell2.innerHTML+");' class='btn btn-success btn-mini'><i class='icon-search'></i></button><hr><div id='tax_"+cell2.innerHTML+"' style='display:none;'><input type='radio' onclick='pph23("+cell2.innerHTML+");' name='ck_"+cell2.innerHTML+"' id='ck_"+cell2.innerHTML+"' value='23	' style='width:15px; height:15px;'><b>PPh 23 - </b> <input type='radio' value='2' onclick='tax2("+cell2.innerHTML+");' name='ck_"+cell2.innerHTML+"' id='ck_"+cell2.innerHTML+"' style='width:15px; height:15px;'><b>Tax 2% - </b> <input name='ck_"+cell2.innerHTML+"' type='radio' onclick='tax6("+cell2.innerHTML+");' value='6' id='ck_"+cell2.innerHTML+"' style='width:15px; height:15px;'><b>Tax 6% </b></div></td><td id='cby_"+cell2.innerHTML+"' style='display:none;'><input class='tgl tgl-ios' id='cbx_"+cell2.innerHTML+"'  onclick='getComboA("+cell2.innerHTML+");' type='checkbox' name='opsi_"+cell2.innerHTML+"' style='display:none;'><label class='tgl-btn' for='cbx_"+cell2.innerHTML+"'></label><b>Other Charge</b></td></tr></table><input id='id_service["+cell2.innerHTML+"]' name='id_service["+cell2.innerHTML+"]' type='hidden'>";
 
 
			var cell4 		= row.insertCell(3);
			cell4.innerHTML = "<div align='right'><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'><tr><td><input class='input-xlarge-i' id='total["+cell2.innerHTML+"]' name='price["+cell2.innerHTML+"]' onchange='setBlurFocus("+cell2.innerHTML+");' value='0' style='width:145px; text-align:right;' type='text' readonly></br><div id='notif_"+cell2.innerHTML+"' style='display:none; float:right;'><font size='2mm'><i>after tax. </i></font></div></br><input type='hidden' id='bf_t_"+cell2.innerHTML+"' name='bf_t_"+cell2.innerHTML+"'><hr><div id='penutup_"+cell2.innerHTML+"' style='display:none;'><font size='2mm'><i>before tax. </i><span style='float:right;' id='before_"+cell2.innerHTML+"'></span></font></br><font size='2mm'><i>tax. </i><span style='float:right;' id='taxi_"+cell2.innerHTML+"'></span></font></div>  <input type='hidden' name='rowcount' value='"+cell2.innerHTML+"'><input type='hidden' name='seq["+cell2.innerHTML+"]'><input type='hidden' name='id["+cell2.innerHTML+"]'><input type='hidden' name='fulus["+cell2.innerHTML+"]' id='fulus["+cell2.innerHTML+"]'><input type='hidden' name='orderid["+cell2.innerHTML+"]' id='orderid["+cell2.innerHTML+"]'><input type='hidden' name='orderty["+cell2.innerHTML+"]' id='orderty["+cell2.innerHTML+"]'><input type='hidden' name='group["+cell2.innerHTML+"]' id='group["+cell2.innerHTML+"]'></td></tr></table></div>";
        }

		function loadgrandtotal(tableID){
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
			var res 				= document.getElementById('grand').value.replace(",","").replace(",","").replace(",","").replace(",","");
			var dis 				= document.getElementById('dis');
			// var baby 			= document.getElementById('grand').value.replace(",","");
			var result_2			= document.getElementById('grandma');
			var adjs 				= document.getElementById('adjs').value;
			var disc 				= document.getElementById('dixc').value.replace(",","").replace(",","").replace(",","");
			var adjs_a 				= document.getElementById('adjs_amt');
			result.value 			= accounting.formatMoney(text-disc);
			result_2.value 			= text;
			
			var goblin				= text * (adjs/100);
			//console.log(goblin);
			//adjs_a.value			= accounting.formatMoney(goblin);
			//adjs_a.value			= Math.ceil(parseInt(text) * parseInt(adjs)/100);
			
			var glendotan			= document.getElementById('peka');
			glendotan.value 		= accounting.formatMoney(parseInt(result.value.replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","")) + parseInt(adjs_baru.replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","")));
	
			
			var has				= document.getElementById("peka").value.replace(",","");
			var discs			= document.getElementById("dixc").value.replace(",","");
			var hasils			= parseInt(discs) * (parseInt(has)/100)
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
			console.log(text);
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

			disc_3.value  			= Math.round(parseInt(adjs_a)/parseInt(result.value.replace(",","").replace(",",""))*100);
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

	
		function undisableTxt2(b_id){
			if(document.getElementById('a'+b_id+'').readOnly == true){
			document.getElementById('a'+b_id+'').readOnly = false;
			}else{
			document.getElementById('a'+b_id+'').readOnly = true;
			}
		}
		
		function disc(){
			var result			= document.getElementById("grand").value.replace(",","").replace(",","").replace(",","").replace(",","");
			var disc			= document.getElementById("dixc");
			var deal			= document.getElementById("dis").value;
			var hasil			= parseInt(deal) * (parseInt(result)/100)
			var lagi			= result - hasil
			
			disc.value			= accounting.formatMoney(hasil);
			//	console.log(result);
		}
		
		function disc2(tableID){

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
				}else{
					text += document.getElementById('fulus['+i+']').value.replace(",","")-1;
				}
					text++;
			}

			var result			= document.getElementById("grand").value.replace(",","").replace(",","").replace(",","").replace(",","").replace(".00","");
			var disc			= document.getElementById("dixc").value;
			var deal			= document.getElementById("dis");
			//console.log(disc);
			if(disc != "0"){
			deal.value			= Math.round(parseInt(disc)/parseInt(text)*100);
			}else{
			deal.value			= "0";
			}

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
		
		function pph23(id){
			var result			= document.getElementById("fulus["+id+"]").value;
			var hasil			= result * (2/100)
			var lagi			= result - hasil

			document.getElementById("penutup_"+id+"").style.display = "";
			document.getElementById("notif_"+id+"").style.display 	= "";
			document.getElementById("before_"+id+"").innerHTML 		= accounting.formatMoney(document.getElementById("fulus["+id+"]").value);
			document.getElementById("bf_t_"+id+"").value	 		= document.getElementById("fulus["+id+"]").value;
			document.getElementById("taxi_"+id+"").innerHTML 		= accounting.formatMoney(hasil);
			document.getElementById("total["+id+"]").value  		= accounting.formatMoney(hasil);
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
		
		function undisableTxt1(){
			document.getElementById('f').readOnly = false;
		}
 
        function deleteRow(tableID){
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;	
			table.deleteRow(rowCount-1);
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
	$hasil		= 1;
	$hasilnya	= 1;
	include './design/koneksi/file.php';
	$con		=mysqli_connect($host, $user, $pass, $database);
	$sql		="select MID(qout_id,5,3) id_quot from mkt_quotation_h order by id_quot desc limit 1";
	if($results		=mysqli_query($con, $sql)){}
	while ($row = mysqli_fetch_assoc($results)) {
	$hasilnya	= $row['id_quot']+1;
	$hasil		= $row['id_quot']+1;
	}
	?>
				<body onload="startTime()">
                    <!-- morris stacked chart -->
                    <div class="row-fluid" onmouseover="loadgrandtotal('example2');">
                        <!-- block --> 
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><b>New Quotation</b></div>
							<div class="muted pull-right" id="txt" style="font-weight: bold;"></div>
                            </div>
							<div class="form-actions">
							<button onclick="undisableTxt()" class="btn btn-primary btn-large"><b>Start</b></button>
																	 
							<div class="btn-group">
							 <button data-toggle="dropdown" class="btn btn-info btn-large dropdown-toggle"><b>Menu</b> <span class="caret"></span></button>
							 <ul class="dropdown-menu">
								<li><a href="<?php echo base_url();?>marketing/list_quotation"><i class="icon-th-large"></i> My Quotation</a></li>
								<?php if ($userlvl != "user"){?>
								<li><a href="<?php echo base_url();?>marketing/list_quotation_app"><i class="icon-th-large"></i> My Quotation Staff</a></li>
								<?php }?>
								<li><a href="<?php echo base_url();?>marketing/group_package"><i class="icon-th-large"></i> Master Group Package</a></li>
							 </ul>
							</div>
							</div>
                            <div class="block-content collapse in" style="display:none;" id="locked">         
                                      <fieldset>
										<form class="form-horizontal" action="<?php echo base_url();?>marketing/save_qoutation" method="post" name="quotation">
										<!--<div id="" style="overflow-y: scroll; height:260px;">-->
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">No. Quotation</label>
                                          <div class="controls">
										  <select style="width: 125px;" name="1"><option value="MCU">MCU</option><option value="MCO">MCU ONSITE</option><!--<option value="VAC">VACCINE</option>--></select> <input type="text" value="<?=$hasilnya;?>" name="20" style="width: 35px;" readonly> - <input class="input-small focused"  style="width: 45px;" placeholder="..." name="3" type="text" id="0" autocomplete="off" disabled required> /<b><?=romanic_number(date('m'));?></b>/<b><?=date('Y');?></b>
										  <input type="hidden" name="4" value="<?=romanic_number(date('m'));?>">
										  <input type="hidden" name="5" value="<?=date('Y');?>">
										  <input type="hidden" name="2" value="<?=$hasil;?>">
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Package Name</label>
                                          <div class="controls">
										  <input class="input-xlarge focused" name="p_name" type="text" id="1" autocomplete="off" value="" disabled required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="select01">Company</label>
                                          <div class="controls">
                                            <select id="id_client" style="width: 285px;" name="p_client" required>
                                              <option value="">- Choose Company Name -</option>
                                              <?php 
											  foreach($get_client->result() as $rows){
											  ?>
											  <option value="<?=$rows->id_Client?>" align="justify"><?=$rows->client_name?></option>
											  <?php
											  }
											  ?>
                                            </select>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Valid Package</label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" id="2" name="v_exp" placeholder="Click Here ..." type="text"autocomplete="off" disabled required> <i class="icon-calendar"></i> 
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Expired Package</label>
                                          <div class="controls">
                                            <input class="input-xlarge datepicker" id="2" name="p_exp" placeholder="Click Here ..." type="text"autocomplete="off" required> <i class="icon-calendar"></i> 
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="focusedInput">Qty. Estimate</label>
                                          <div class="controls">
                                            <input class="input-small" name="qty"  type="number" autocomplete="off" required> <i class="icon-user"></i> <b>Pax</b>
                                          </div>
                                        </div>
										</br>
										
		
										</br>
										</br>
										<div style="width:100%; height:100%	; overflow: auto; float:center;">
										<table class="table table-hover" id="example2">
										    <thead>
                                          	<tr>
												<th>No</th>
												<th>Group</th>
												<th>Service</th>
												<th><div align="right">Price</div></th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<TD>1</TD>
												<TD>
												<table style='border-radius:10px; overflow: auto; border: 0px solid #282929; top: 100px;'>
												<tr>
													<td>
													<select onchange='showDiv(this.value, 1);' name='g_change_1' id='group_1' style='width: 190px;' disabled required>
													<option value=''>- Choose Group -</option>
													<?php 
													foreach($sv_group->result() as $rows){
													?>
													<option value='<?=$rows->id_serv_group?>' align='justify'><?=$rows->group_desc?></option>
													<?php
													}
													?>
													</select>
													</td>
												</tr>
												<tr>
													<td>
													<select id='aa1' name='one_1' style='width: 190px; display:none;'>
													<option value=''>- Choose Lab Group -</option>
													<?php 
													foreach($sv_lab->result() as $rows){
													?>
													<option value='<?=$rows->id_lab_item_group?>' align='justify'><?=$rows->group_name?></option>
													<?php
													}
													?>
													</select>
													<select id='bb1' name='two_1' style='width: 190px; display:none;'>
													<option value=''>- Choose Rad. Group -</option>
													<?php 
													foreach($sv_rad->result() as $rows){
													?>
													<option value='<?=$rows->id_rad_group?>' align='justify'><?=$rows->group_desc?></option>
													<?php
													}
													?>
													</select>
													<INPUT id='cc1' name="three_1" placeholder="Group Examination" style='width: 176px; text-align:left; display:none; text-transform: uppercase;' type='text' >
													</td>
												</tr>
												<tr>
													<td>													
													<select id='dd1' name='mark_1' style='width: 190px; display:none;'>
													<option value=''>- Choose Sampling -</option>
													<?php 
													foreach($sv_mark->result() as $rowa){
													?>
													<option value='<?=$rowa->id?>' align='justify'><?=$rowa->nama_group?></option>
													<?php
													}
													?>
													</select></td>
												</tr>
												</table>	
												</TD>
												<TD>
												<table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><input type='text' name='service[1]' style='width:285px' placeholder='Service item' id='a1' readonly required/> <button id='pop1' type='button' onclick='popup(1); loadgrandtotal("example2");' class='btn btn-success btn-mini'><i class='icon-search'></i></button> <hr>
													<div id="tax_1" style="display:none;"><input type="radio" onclick="pph23(1);" name="ck_1" id="ck_1" value="23" style="width:15px; height:15px;"><b>PPh 23 - </b> <input type="radio" onclick="tax2(1);" name="ck_1" id="ck_1" value="2" style="width:15px; height:15px;"><b>Tax 2% - </b> <input name="ck_1" type="radio" onclick="tax6(1);" value="6" id="ck_1" style="width:15px; height:15px;"><b>Tax 6% </b></div></td>
													<td id="cby_1" style='display:none;'><input class='tgl tgl-ios' id='cbx_1'  onclick='getComboA(1);' type='checkbox' name='opsi_1' style='display:none;'>
													<label class='tgl-btn' for='cbx_1' ></label><b>Other Charge</b>													
													</td>
												</tr>
												</table>									
												</TD>
												<TD>	 
												<div align="right">
												<table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td>
													<INPUT id="total[1]" name="price[1]" value="0" style="width:145px; text-align:right" onmouseover="loadgrandtotal('example2');" type="text" onchange="setBlurFocus(1);" readonly>
													</br>
													<div id="notif_1" style="display:none; float:right;"><font size="2mm"><i>after tax. </i></font></div>
													</br>
													<hr>
													<div id="penutup_1" style="display:none;">
													<font size="2mm"><i>before tax. </i><span style="float:right;" id="before_1"></span></font>
													</br><font size="2mm"><i>tax. </i><span style="float:right;" id="taxi_1"></span></font>
													<input type="hidden" id="bf_t_1" name="bf_t_1">
													</div>
													<input type="hidden" name="seq[1]"/> 
													<input name="id_service[1]" id="id_service[1]" type="hidden">
													<input id="fulus[1]" name="fulus[1]" type="hidden">
													<input name="orderid[1]" type="hidden">
													<input id="orderty[1]" name="orderty[1]" type="hidden">
													<input name="group[1]" type="hidden">
													<input name="rowcount" value="1" type="hidden">
													</td>
												</tr>
												</table>
												</div>
												</TD>
											</tr>
											</tbody>
										</table>
										<INPUT class="btn btn-success" type="button" value="Add" onclick="addRow('example2')" id="plus" disabled/>
										<INPUT class="btn btn-danger" id="negatif" type="button" value="Delete" onclick="deleteRow('example2'); loadgrandtotal('example2');"disabled/>	
										</fieldset>  
										<table class="table table-hover" style="border-radius:10px;">
											<tr class="success">
											<td><div align="right"><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><b>Total</b> <INPUT class="input-xlarge-in focused" onkeyup="loadgrandtotal('example2');" id="total" name="total_price" value="0" style="width:145px; text-align:right" type="text" readonly></td>
												</tr>
												</table></div></td>
											</tr>
											<tr class="error">
											<td><div align="right"><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><b>Discount </b> <INPUT readonly id="dis" class="input-xlarge-in focused" name="disc_persen" value="0" style="width:45px; text-align:right" autocomplete="off" max="100" type="number"> <INPUT onkeyup="disc2('example2');" onchange="setBlurFocus3();" class="input-xlarge-in focused" id="dixc" name="disc_amnt" value="0" style="width:145px; text-align:right" type="text"></td>
												</tr>
												</table></div></td>
											</tr>
											<tr class="success">
											<td><div align="right"><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><b>Cost</b> <INPUT class="input-xlarge-in focused" onkeyup="loadgrandtotal('example2');" id="grand" name="amount_total" value="0" style="width:145px; text-align:right" type="text" readonly></td>
												</tr>
												</table></div></td>
											</tr>
											<tr class="info">
											<td><div align="right"><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><b>Margin</b> <INPUT readonly class="input-xlarge-in focused" id="adjs" name="adjs_amount" value="0" style="width:45px; text-align:right" autocomplete="off" max="100" type="number"> <INPUT class="input-xlarge-in focused" autocomplete="off"  id="adjs_amt" name="adjs_nominal" value="0" onkeyup="loadgrandtotal2('example2');" style="width:145px; text-align:right" onchange="setBlurFocus2();"  type="text"><input id="grandma" type="hidden"></td>
												</tr>
												</table></div></td>
											</tr>
											<tr class="success">
											<td><div align="right"><table style='border-radius:10px; overflow:hidden; border: 0px solid #282929;'>
												<tr>
													<td><b>Sell Price</b> <INPUT class="input-xlarge-in focused" id="peka" onkeyup="loadgrandtotal3();" name="peka" value="0" style="width:145px; text-align:right" type="text"></td>
												</tr>
												</table></div></td>
											</tr>
										</table>
									    </div>
										<div id="lock" align="center"><font color="red"><b><p class="hi">Click Start to Begin</p></b></font></div>
										<div id="myAlert" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h5>Alert!</h5>
											</div>
											<div class="modal-body">
												<p>Are you sure ? [close] button to check again...</p>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" disabled id="save" value="Save">
												<a data-dismiss="modal" class="btn btn-warning" href="#">Close</a>
											</div>
										</div>
										<div class="form-actions">
										<div style="float: left;">
										<a href="#myAlert" data-toggle="modal" class="btn btn-success"><b>Submit</b></a>
										</div>
										
										<div style="float:right;">
										<button class="btn btn-danger" type="reset"><b>Reset</b></button> 
										</div>
                                        </div>
										<legend></legend>
										</form>                   						
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
		<!--/.fluid-container-->
    <link href="<?php echo base_url();?>design/vendors/datepicker.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/uniform.default.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/chosen.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">
    <script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/jquery.uniform.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url();?>design/vendors/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>
    <script src="<?php echo base_url();?>design/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>design/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>design/assets/form-validation.js"></script>
	<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
	<script>
	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
    </script>
</body>