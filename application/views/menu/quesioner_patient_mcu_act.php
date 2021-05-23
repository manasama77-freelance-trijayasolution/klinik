		<?php
			$id = $this->uri->segment(3);
			if ($id=="ok"){
		?>
			<div class="alert alert-success">
				<button class="close" data-dismiss="alert">&times;</button>
				<strong>Success!</strong> Input Questionnaire Medical Check Up
			</div>
		<?php
			} else if ($id=="change") {
		?>
			<div class="alert alert-success">
				<button class="close" data-dismiss="alert">&times;</button>
				<strong>Success!</strong> Update Data Questionnaire Medical Check Up
			</div>
		<?php
			} else if ($id=="del") {
		?>
			<div class="alert alert-success">
				<button class="close" data-dismiss="alert">&times;</button>
				<strong>Success!</strong> Delete User
			</div>
		<?php
			}
		?>		
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
			window.location.href = "<?php echo base_url();?>patient/quesioner_patient_mcu/edit";
		  }

		</script>
						<!-- morris stacked chart -->
						<div class="row-fluid">
										
							<!-- block --> 
							<div class="block">
								<div class="navbar navbar-inner block-header">
								<div class="muted pull-left"><b>Form Questionnaire Medical Check Up</b></div>
								</div>
								<div class="form-actions">
								 <div class="btn-group">
								 <button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-th"></i> Menu <span class="caret"></span></button>
								 <ul class="dropdown-menu">
									<li><a href="<?php echo base_url();?>patient/quesioner_patient_mcu_local"><i class="icon-th-large"></i> Local</a></li>
									<li><a href="<?php echo base_url();?>patient/quesioner_patient_tread"><i class="icon-th-large"></i> Treadmill</a></li>
									<li><a href="<?php echo base_url();?>patient/quesioner_patient_gyn"><i class="icon-th-large"></i> Gynecology</a></li>
								 </ul>
								</div>									 
								</div>
								<div class="block-content collapse in">
									<div class="span12">           
										  <fieldset>	
											<form class="form-horizontal" action="<?php echo base_url();?>patient/save_que_mcu" method="post" name="mst_pr">
			
											<div class="control-group">
												<label class="control-label" for="focusedInput">Registration ID</label>
												<div class="controls">
												<input class="input-xlarge focused" value="<?php echo $_POST['id_pat'];?>" type="hidden" name="id_pat">
												<input class="input-xlarge focused" value="<?php echo $_POST['pat_mrn'];?>" name="pat_mrn" type="text" id="myText01" maxlength="0" autocomplete="off" placeholder=" ... " required>
												<input name="id_reg" type="hidden" id="" value="<?php echo $_POST['id_reg'];?>" autocomplete="off" >
												<input name="type" type="hidden" id="" value="<?php echo $_POST['type'];?>" autocomplete="off" >						
												</div>
											</div>
											
											<div class="control-group">
											<label class="control-label" for="focusedInput">Patient Name</label>
											<div class="controls">
												<input class="input-xlarge focused" value="<?php echo $_POST['pat_name'];?>" name="pat_name" type="text" id="myText02" maxlength="0" autocomplete="off" >
											</div>
											</div>
											
											<div class="control-group">
											<label class="control-label" for="focusedInput">Charge Rule</label>
											<div class="controls">
												<input class="input-xlarge focused" value="<?php echo $_POST['charge_rule'];?>" name="charge_rule" type="text" id="myText03" maxlength="0" autocomplete="off">
											</div>
											</div>
											
											<div class="control-group">
											<label class="control-label" for="focusedInput">Age</label>
											<div class="controls">
												<input class="input-xlarge focused" value="<?php echo $_POST['pat_age'];?>" name="pat_age" type="text" id="myText03" maxlength="0" autocomplete="off">
											</div>
											</div>
														
											<div class="control-group">
											<label class="control-label" for="focusedInput">Client Name</label>
											<div class="controls">
												<input class="input-xlarge focused" value="<?php echo $_POST['client_name'];?>" name="client_name" type="text" id="myText03" maxlength="0" autocomplete="off">
											</div>
											</div>

											<div id="" style="overflow-y: scroll; height:460px;">
											<div class="row-fluid">
												<!-- block -->
												<div class="block">
													<div class="navbar navbar-inner block-header">
														<div class="muted pull-left"><b>Questionnaire Form</b></div>
													</div>
													<div class="block-content collapse in">
														<div class="span12">
															<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
																<thead>
																	<tr>
																		<th>No</th>
																		<th>Subject</th>
																		<th>Yes</th>
																		<th>No</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>1</td>
																		<td>Difficulty in vision</td>
																		<td><input type="radio" name="vd" value="1" required></td>
																		<td><input type="radio" name="vd" value="0" required></td>
																	</tr>
																	<tr>
																		<td>2</td>
																		<td>Any ear discharge</td>
																		<td><input type="radio" name="ed" value="1" required></td>
																		<td><input type="radio" name="ed" value="0" required></td>
																	</tr>
																	<tr>
																		<td>3</td>
																		<td>Asthma / Bronchitis</td>
																		<td><input type="radio" name="ab" value="1" required></td>
																		<td><input type="radio" name="ab" value="0" required></td>
																	</tr>
																	<tr>
																		<td>4</td>
																		<td>Hay fever / Other allergy</td>
																		<td><input type="radio" name="hf" value="1" required></td>
																		<td><input type="radio" name="hf" value="0" required></td>
																	</tr>
																	<tr>
																		<td>5</td>
																		<td>Any skin trouble</td>
																		<td><input type="radio" name="st" value="1" required></td>
																		<td><input type="radio" name="st" value="0" required></td>
																	</tr>
																	<tr>
																		<td>6</td>
																		<td>Tuberculosis</td>
																		<td><input type="radio" name="tb" value="1" required></td>
																		<td><input type="radio" name="tb" value="0" required></td>
																	</tr>
																	<tr>
																		<td>7</td>
																		<td>Shortness of breath</td>
																		<td><input type="radio" name="bs" value="1" required></td>
																		<td><input type="radio" name="bs" value="0" required></td>
																	</tr>
																	<tr>
																		<td>8</td>
																		<td>Coughed / vomited blood</td>
																		<td><input type="radio" name="bc" value="1" required></td>
																		<td><input type="radio" name="bc" value="0" required></td>
																	</tr>
																	<tr>
																		<td>9</td>
																		<td>Stomach ulcer</td>
																		<td><input type="radio" name="su" value="1" required></td>
																		<td><input type="radio" name="su" value="0" required></td>
																	</tr>
																	<tr>
																		<td>10</td>
																		<td>Recurrent indigestion</td>
																		<td><input type="radio" name="ri" value="1" required></td>
																		<td><input type="radio" name="ri" value="0" required></td>
																	</tr>
																	<tr>
																		<td>11</td>
																		<td>Jaundice or hepatitis</td>
																		<td><input type="radio" name="jh" value="1" required></td>
																		<td><input type="radio" name="jh" value="0" required></td>
																	</tr>
																	<tr>
																		<td>12</td>
																		<td>Gall bladder disease / gall stones</td>
																		<td><input type="radio" name="gs" value="1" required></td>
																		<td><input type="radio" name="gs" value="0" required></td>
																	</tr>
																	<tr>
																		<td>13</td>
																		<td>High trigylcerides</td>
																		<td><input type="radio" name="ts" value="1" required></td>
																		<td><input type="radio" name="ts" value="0" required></td>
																	</tr>
																	<tr>
																		<td>14</td>
																		<td>Blood in stool (Motion)</td>
																		<td><input type="radio" name="bis" value="1" required></td>
																		<td><input type="radio" name="bis" value="0" required></td>
																	</tr>
																	<tr>
																		<td>15</td>
																		<td>Varicose veins</td>
																		<td><input type="radio" name="vv" value="1" required></td>
																		<td><input type="radio" name="vv" value="0" required></td>
																	</tr>
																	<tr>
																		<td>16</td>
																		<td>Cancer</td>
																		<td><input type="radio" name="cr" value="1" required></td>
																		<td><input type="radio" name="cr" value="0" required></td>
																	</tr>
																	<tr>
																		<td>17</td>
																		<td>Heart disease</td>
																		<td><input type="radio" name="hd" value="1" required></td>
																		<td><input type="radio" name="hd" value="0" required></td>
																	</tr>
																	<tr>
																		<td>18</td>
																		<td>Rheumatic disease</td>
																		<td><input type="radio" name="rd" value="1" required></td>
																		<td><input type="radio" name="rd" value="0" required></td>
																	</tr>
																	<tr>
																		<td>19</td>
																		<td>Abnormal heart beat</td>
																		<td><input type="radio" name="abh" value="1" required></td>
																		<td><input type="radio" name="abh" value="0" required></td>
																	</tr>
																	<tr>
																		<td>20</td>
																		<td>High blood pressure</td>
																		<td><input type="radio" name="hbp" value="1" required></td>
																		<td><input type="radio" name="hbp" value="0" required></td>
																	</tr>
																	<tr>
																		<td>21</td>
																		<td>Stroke</td>
																		<td><input type="radio" name="str" value="1" required></td>
																		<td><input type="radio" name="str" value="0" required></td>
																	</tr>
																	<tr>
																		<td>22</td>
																		<td>Serious chest pain</td>
																		<td><input type="radio" name="sc" value="1" required></td>
																		<td><input type="radio" name="sc" value="0" required></td>
																	</tr>
																	<tr>
																		<td>23</td>
																		<td>Any blood disease</td>
																		<td><input type="radio" name="abd" value="1" required></td>
																		<td><input type="radio" name="abd" value="0" required></td>
																	</tr>
																	<tr>
																		<td>24</td>
																		<td>Kidney disease (e.g. stoner)</td>
																		<td><input type="radio" name="kd" value="1" required></td>
																		<td><input type="radio" name="kd" value="0" required></td>
																	</tr>
																	<tr>
																		<td>25</td>
																		<td>Painful passage of urine / blood / pus in urine</td>
																		<td><input type="radio" name="pp" value="1" required></td>
																		<td><input type="radio" name="pp" value="0" required></td>
																	</tr>
																	<tr>
																		<td>26</td>
																		<td>Prostatic disease</td>
																		<td><input type="radio" name="pd" value="1" required></td>
																		<td><input type="radio" name="pd" value="0" required></td>
																	</tr>
																	<tr>
																		<td>27</td>
																		<td>Diabetes</td>
																		<td><input type="radio" name="db" value="1" required></td>
																		<td><input type="radio" name="db" value="0" required></td>
																	</tr>
																	<tr>
																		<td>28</td>
																		<td>Headache / Migraine</td>
																		<td><input type="radio" name="hm" value="1" required></td>
																		<td><input type="radio" name="hm" value="0" required></td>
																	</tr>
																	<tr>
																		<td>29</td>
																		<td>Dizziness / Fainting</td>
																		<td><input type="radio" name="df" value="1" required></td>
																		<td><input type="radio" name="df" value="0" required></td>
																	</tr>
																	<tr>
																		<td>30</td>
																		<td>Joints / Spinal trougle</td>
																		<td><input type="radio" name="jst" value="1" required></td>
																		<td><input type="radio" name="jst" value="0" required></td>
																	</tr>
																	<tr>
																		<td>31</td>
																		<td>Serious accident / fracture</td>
																		<td><input type="radio" name="saf" value="1" required></td>
																		<td><input type="radio" name="saf" value="0" required></td>
																	</tr>
																	<tr>
																		<td>32</td>
																		<td>Surgical operation</td>
																		<td><input type="radio" name="so" value="1" required></td>
																		<td><input type="radio" name="so" value="0" required></td>
																	</tr>
																	<tr>
																		<td>33</td>
																		<td>Fear of heights</td>
																		<td><input type="radio" name="fh" value="1" required></td>
																		<td><input type="radio" name="fh" value="0" required></td>
																	</tr>
																	<tr>
																		<td>34</td>
																		<td>Rejected for employment or insurance for Medical reasons</td>
																		<td><input type="radio" name="re" value="1" required></td>
																		<td><input type="radio" name="re" value="0" required></td>
																	</tr>
																	<tr>
																		<td>35</td>
																		<td>Awarded benefits for industrial injury/illness</td>
																		<td><input type="radio" name="abi" value="1" required></td>
																		<td><input type="radio" name="abi" value="0" required></td>
																	</tr>
																	<tr>
																		<td>36</td>
																		<td>Treated for a mental condition</td>
																		<td><input type="radio" name="tmc" value="1" required></td>
																		<td><input type="radio" name="tmc" value="0" required></td>
																	</tr>
																	<tr>
																		<td>37</td>
																		<td>Treated for problem drinking or drug abuse</td>
																		<td><input type="radio" name="tpd" value="1" required></td>
																		<td><input type="radio" name="tpd" value="0" required></td>
																	</tr>
																	<tr>
																		<td>38</td>
																		<td>Exposed to toxic substance or noise</td>
																		<td><input type="radio" name="ets" value="1" required></td>
																		<td><input type="radio" name="ets" value="0" required></td>
																	</tr>
																	<tr>
																		<td>39</td>
																		<td>Have you had any illnesses not mentioned above</td>
																		<td><input type="radio" name="hy" value="1" required></td>
																		<td><input type="radio" name="hy" value="0" required></td>
																	</tr>
																	<tr>
																		<td>40</td>
																		<td>Are you on reguler medication</td>
																		<td><input type="radio" name="ayo" value="1" required></td>
																		<td><input type="radio" name="ayo" value="0" required></td>
																	</tr>
																	<tr>
																		<td>41</td>
																		<td>Are you allergic to any medication</td>
																		<td><input type="radio" name="aya" value="1" required></td>
																		<td><input type="radio" name="aya" value="0" required></td>
																	</tr>
																	<tr>
																		<td>42</td>
																		<td>Do you smoke</td>
																		<td><input type="radio" name="dys" value="1" required></td>
																		<td><input type="radio" name="dys" value="0" required></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<!-- /block -->
											</div>				
											
											<div class="row-fluid">
												<!-- block -->
												<div class="block">
													<div class="navbar navbar-inner block-header">
														<div class="muted pull-left"><b>(For Women Only) Have You / Ever Had :</b></div>
													</div>
													<div class="block-content collapse in">
														<div class="span12">
															<table class="table table-hover">
																<thead>
																	<tr>
																		<th>No</th>
																		<th colspan="2">Subject</th>
																		<th>Yes</th>
																		<th>No</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>43</td>
																		<td>Any gynaecological abnormality</td>
																		<td></td>
																		<td><input type="radio" name="aga" value="1" required></td>
																		<td><input type="radio" name="aga" value="0" required></td>
																	</tr>
																	<tr>
																		<td>44</td>
																		<td>Regular Periode</td>
																		<td>First menstruation Age <select id="select01" class="chzn-select" name="yol" style="width: 99px;">
																		<option value="0"> Choose </option>
																		<?php 
																		for ($x = 8; $x <= 88; $x++) {
																		?>
																		<option value="<?=$x?>"><?=$x?></option>
																		<?php
																			} 
																		?>
																		</select> yo</td>
																		<td><input type="radio" name="rpe" value="1" required></td>
																		<td><input type="radio" name="rpe" value="0" required></td>
																	</tr>
																	<tr>
																		<td>45</td>
																		<td>Are you pregnant</td>
																		<td>LMP <input size="8" name="lmp" type="text" id="myText98" autocomplete="off" placeholder=" ... "></td>
																		<td><input type="radio" name="ayp" value="1" required></td>
																		<td><input type="radio" name="ayp" value="0" required></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<!-- /block -->
											</div>

											<div class="row-fluid">
												<!-- block -->
												<div class="block">
													<div class="navbar navbar-inner block-header">
														<div class="muted pull-left"><b>Family Medical History</b></div>
													</div>
													<div class="block-content collapse in">
														<div class="span12">
															<table class="table table-hover">
																<thead>
																	<tr>
																		<th>Family</th>
																		<th>Alive, Age</th>
																		<th>Medical History</br>(Diabetes mellitus, hypertension, etc)</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Father</td>
																		<td>
																		<select id="select01" style="width: 98px;" name="fat_alive">
																		<option value="0">- Choose -</option>
																		<option value="1">Yes</option>
																		<option value="2">No</option>
																		</select>
																		<select id="select01" style="width: 98px;" name="fat_alive_age">
																		<option value="0">- Choose -</option>
																		<?php 
																		for ($x = 23; $x <= 198; $x++) {
																		?>
																		<option value="<?=$x?>"><?=$x?></option>
																		<?php
																			} 
																		?>
																		</select>
																		</td>
																		<td><input size="10" name="fat_mh" type="text" id="myText07" autocomplete="off" placeholder=" ... "></td>
																	</tr>
																	<tr>
																		<td>Mother</td>
																		<td>
																		<select id="select01" style="width: 98px;" name="mot_alive">
																		<option value="0">- Choose -</option>
																		<option value="1">Yes</option>
																		<option value="2">No</option>
																		</select>
																		<select id="select01" style="width: 98px;" name="mot_alive_age">
																		<option value="0">- Choose -</option>
																		<?php 
																		for ($x = 23; $x <= 198; $x++) {
																		?>
																		<option value="<?=$x?>"><?=$x?></option>
																		<?php
																			} 
																		?>
																		</select>
																		</td>
																		<td><input size="10" name="mot_mh" type="text" id="myText07" autocomplete="off" placeholder=" ... "></td>
																	</tr>
																	<tr>
																		<td>Brother / Sister</td>
																		<td>
																		<select id="select01" style="width: 98px;" name="bro1_alive">
																		<option value="0">- Choose -</option>
																		<option value="1">Yes</option>
																		<option value="2">No</option>
																		</select>
																		<select id="select01" style="width: 98px;" name="bro1_alive_age">
																		<option value="0">- Choose -</option>
																		<?php 
																		for ($x = 1; $x <= 198; $x++) {
																		?>
																		<option value="<?=$x?>"><?=$x?></option>
																		<?php
																			} 
																		?>
																		</select>
																		</td>
																		<td><input size="10" name="bro1_mh" type="text" id="myText07" autocomplete="off" placeholder=" ... "></td>
																	</tr>
																	<tr>
																		<td>Brother / Sister</td>
																		<td>
																		<select id="select01" style="width: 98px;" name="bro2_alive">
																		<option value="0">- Choose -</option>
																		<option value="1">Yes</option>
																		<option value="2">No</option>
																		</select>
																		<select id="select01" style="width: 98px;" name="bro2_alive_age">
																		<option value="0">- Choose -</option>
																		<?php 
																		for ($x = 1; $x <= 198; $x++) {
																		?>
																		<option value="<?=$x?>"><?=$x?></option>
																		<?php
																			} 
																		?>
																		</select>
																		</td>
																		<td><input size="10" name="bro2_mh" type="text" id="myText07" autocomplete="off" placeholder=" ... "></td>
																	</tr>
																	<tr>
																		<td>Brother / Sister</td>
																		<td>
																		<select id="select01" style="width: 98px;" name="bro3_alive">
																		<option value="0">- Choose -</option>
																		<option value="1">Yes</option>
																		<option value="2">No</option>
																		</select>
																		<select id="select01" style="width: 98px;" name="bro3_alive_age">
																		<option value="0">- Choose -</option>
																		<?php 
																		for ($x = 1; $x <= 198; $x++) {
																		?>
																		<option value="<?=$x?>"><?=$x?></option>
																		<?php
																			} 
																		?>
																		</select>
																		</td>
																		<td><input size="10" name="bro3_mh" type="text" id="myText07" autocomplete="off" placeholder=" ... "></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<!-- /block -->
											</div>
											
											<div class="row-fluid">
												<!-- block -->
												<div class="block">
													<div class="navbar navbar-inner block-header">
														<div class="muted pull-left"><b>Habits</b></div>
													</div>
													<div class="block-content collapse in">
														<div class="span12">
															<table class="table table-hover">
																<thead>
																	<tr>
																		<th>No</th>
																		<th colspan="2">Habits</th>
																		<th>Frequency</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>1</td>
																		<td>Smoking</td>
																		<td>
																		<select id="select01" class="chzn-select" name="smk">
																		<option value="0">- Choose -</option>
																		<option value="1">Yes</option>
																		<option value="0">No</option>
																		</select>
																		</td>
																		<td><input size="10" name="smk_freq" type="text" id="myText07" autocomplete="off" placeholder=" ... "></td>
																	</tr>
																	<tr>
																		<td>2</td>
																		<td>Alcohol</td>
																		<td>
																		<select id="select01" class="chzn-select" name="alc">
																		<option value="0">- Choose -</option>
																		<option value="1">Yes</option>
																		<option value="0">No</option>
																		</select>
																		</td>
																		<td><input size="10" name="alc_freq" type="text" id="myText07" autocomplete="off" placeholder=" ... "></td>
																	</tr>
																	<tr>
																		<td>3</td>
																		<td>Drugs</td>
																		<td><select id="select01" class="chzn-select" name="drugs_hab">
																		<option value="0">- Choose -</option>
																		<option value="1">Yes</option>
																		<option value="0">No</option>
																		</select> *Routine Consume</td>
																		<td><input size="10" name="drugs_freq" type="text" id="myText07" autocomplete="off" placeholder=" ... "></td>
																	</tr>
																	<tr>
																		<td>4</td>
																		<td>Exercise</td>
																		<td><textarea placeholder=" ... " name="exercise"></textarea></td>
																		<td><textarea placeholder=" ... " name="exercise_freq"></textarea></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<!-- /block -->
											</div>

											<div id="myAlert" class="modal hide">
												<div class="modal-header">
													<button data-dismiss="modal" class="close" type="button">&times;</button>
													<h3>Check Again</h3>
												</div>
												<div class="modal-body">
													<p>Are You Sure ?</p>
												</div>
												<div class="modal-footer">
													<input type="submit" class="btn" value="Save" id="myText123" disabled>
													<a data-dismiss="modal" class="btn" href="#">Cancel</a>
												</div>
											</div>
											</div>
											<div class="form-actions">
											<a href="#myAlert" data-toggle="modal" class="btn btn-success">Save</a>
											<button type="reset" class="btn btn-primary">Reset</button>
											</div>
							
										<legend></legend>
										</form>
										</fieldset>                     						
									</div>
								</div>
							</div>
							<!-- /block -->
						</div>
			<!--/.fluid-container-->
			<script src="<?php echo base_url();?>design/vendors/jquery-1.9.1.js"></script>
			<script src="<?php echo base_url();?>design/bootstrap/js/bootstrap.min.js"></script>
			<script src="<?php echo base_url();?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
			<link href="<?php echo base_url();?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
			<script src="<?php echo base_url();?>design/assets/scripts.js"></script>
			<script src="<?php echo base_url();?>design/assets/DT_bootstrap.js"></script>
	</html>