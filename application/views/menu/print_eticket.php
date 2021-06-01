

	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>design/etiket/css/style.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>design/etiket/css/print.css' media="print" />
	<script type='text/javascript' src='<?php echo base_url();?>design/etiket/js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url();?>design/etiket/js/example.js'></script>
<style>
@media all
{
  .page-break  { 
  display:none;
   }
  .isi {
      font-size:14px;
      font-weight:bold;
      }
}
@media print
{
  .page-break  { display:block; page-break-before:always; }
}

@media print {
  footer {page-break-after: always;}
}
</style>
	<body>
	<?php 
    $xx     = array('4','8','16','20','24','28','32');
    $no     = 1;
    $i      = 0;
    foreach ($list_phar->result() as $value) { 
    ?>
	<div id="page-wrap">
		<div id="identity">
            <textarea id="address">
Klinik drg. Magista Lutfia
Head Office:
Jl. Merpati Blok D18 No. 5 RT.007/RW.009, Gebang Raya, Priuk Tangerang City, Banten 15132
Phone: 0812-8105-2276
			</textarea>

            <div id="logo">
              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" style="width: 65px; height:30" src="<?php echo base_url();?>design/images/logokyoai.png" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">
            <table id="meta">
                <tr>
                    <td class="meta-head">Patient Name</td>
                    <td><div class="due"><?=strtoupper($value->pat_name);?></div></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><div class="due"><?php echo date("d M Y");;?></div></td>
                </tr>
                <tr>
                    <td class="meta-head">Medication</td>
                    <td class="meta-head"><div class="due"><textarea><?=$value->item_name;?></textarea></div></td>
                </tr>
				<tr>
                    <td class="meta-head">Instruction</td>
                    <td class="meta-head"><div class="due"><textarea>1 <?=$value->baseunit;?></textarea></div></td>
                </tr>
				<tr>
                    <td class="meta-head">Times</td>
                    <td><div class="due"><?=$value->dosage_main;?> times <?=$value->dosage_days;?> days </div></td>
                </tr>
            </table>
		
		</div>


<table id="items">
		  
<tr class="item-row">
<td class="item-name"><input style="width:15px; height:20px;" type="checkbox" id="9" name="complete" value="1"> <b>Before Meal</b></td>
<td class="item-name"><input style="width:15px; height:20px;" type="checkbox" id="9" name="complete" value="1"> <b>After Meal</b></td>
<td class="item-name"><input style="width:15px; height:20px;" type="checkbox" id="9" name="complete" value="1"> <b>Until Finish</b></td>
</tr>

<tr class="item-row">
<td class="item-name"><input style="width:15px; height:20px;" type="checkbox" id="9" name="complete" value="1"> <b>If Necessary</b></td>
<td class="item-name"><input style="width:15px; height:20px;" type="checkbox" id="9" name="complete" value="1"> <b>Before Sleep</b></td>
<td class="item-name"></td>
</tr>

<tr><td colspan="3"></td></tr>

<tr class="item-row">
<td class="item-name"><input style="width:15px; height:20px;" type="checkbox" id="9" name="complete" value="1"> <b>Morning</b></td>
<td class="item-name"><input style="width:15px; height:20px;" type="checkbox" id="9" name="complete" value="1"> <b>After Noon</b></td>
<td class="item-name"><input style="width:15px; height:20px;" type="checkbox" id="9" name="complete" value="1"> <b>Evening</b></td>		
</tr>

</table>
		

		<div id="terms">
		  <h5>NOTES</h5>
		  <textarea>...</textarea>
		</div>

    </div>

    <?php 
        
   
        if (in_array($no, $xx)) {
            echo '<div class="page-break"></div> </br>';
        }
        $no++;
    } 
    ?>

</body>
	