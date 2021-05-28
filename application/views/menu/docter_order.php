<link href="<?= base_url(); ?>design/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
<style>
	.modal-large {
		width: 800px;
		margin-left: -360px;
	}

	.modal-backdrop,
	modal-backdrop.fade.in {
		background-color: rgba(0, 0, 0, .7);
	}

	.gambar_gigi1>input[type="checkbox"] {
		margin-top: 26px;
		margin-left: 22px;
		outline: solid 2px #000;
	}

	.gambar_gigi2>input[type="checkbox"] {
		margin-top: 12px;
		margin-left: 23px;
		outline: solid 1px #000;
	}

	.gambar_gigi1 {
		text-align: center;
		background-image: url('<?= base_url(); ?>design/images/odontogram/single.jpg');
		background-position: center;
		background-repeat: no-repeat;
		width: 30px;
		height: 63px;
	}

	.gambar_gigi2 {
		text-align: center;
		background-image: url('<?= base_url(); ?>design/images/odontogram/small.jpg');
		background-position: center;
		background-repeat: no-repeat;
		width: 30px;
		height: 36px;
	}

	.container .row-fluid #desc_gigi [class*="span"] {
		margin-top: 20px;
		margin-left: 15px;
	}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="container">
	<form id="form_doctor_order" class="form-horizontal">
		<div class="row-fluid">
			<div class="span12">
				<div class="block">
					<div class="navbar">
						<div class="navbar-inner">
							<h4>Doctor Order</h4>
						</div>
					</div>

					<div class="block-content">
						<div class="control-group">
							<label class="control-label" for="id_registration">ID Registration</label>
							<div class="controls">
								<input type="text" class="input-medium" id="id_registration" name="id_registration" readonly />
								<button type="button" class="btn btn-info" onclick="showModalListRegistration();">
									<i class="icon-search"></i>
								</button>
							</div>
						</div>

						<hr />

						<div class="control-group">
							<label class="control-label" for="patient_name">Patient Name</label>
							<div class="controls">
								<input type="text" class="input-xlarge uneditable-input" id="patient_name" name="patient_name" readonly />
								<input type="hidden" id="id_patient" name="id_patient" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="charge_rule">Charge Rule</label>
							<div class="controls">
								<input type="text" class="input-large" id="charge_rule" name="charge_rule" readonly />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="age">Age</label>
							<div class="controls">
								<input type="text" class="input-large" id="age" name="age" readonly />
							</div>
						</div>

					</div>

					<div class="form-actions">
						<button type="button" class="btn btn-primary" id="button_registration_list">Show</button>
						<button type="reset" class="btn">Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="row-fluid" id="section_odontogram" style="display: none;">
			<div class="span12">
				<div class="block">
					<div class="navbar">
						<div class="navbar-inner">
							<h4>Odontogram</h4>
						</div>
					</div>
					<form id="form_odontogram" class="form-horizontal" action="#" method="get">
						<div class="block-content">
							<div class="row-fluid">

								<div class="span12" style="text-align: center;">
									<table class="table" id="table_odontogram_1">
										<thead>
											<tr>
												<th style="text-align: center;">18</th>
												<th style="text-align: center;">17</th>
												<th style="text-align: center;">16</th>
												<th style="text-align: center;">15</th>
												<th style="text-align: center;">14</th>
												<th style="text-align: center;">13</th>
												<th style="text-align: center;">12</th>
												<th style="text-align: center;">11</th>
												<th style="text-align: center;">21</th>
												<th style="text-align: center;">22</th>
												<th style="text-align: center;">23</th>
												<th style="text-align: center;">24</th>
												<th style="text-align: center;">25</th>
												<th style="text-align: center;">26</th>
												<th style="text-align: center;">27</th>
												<th style="text-align: center;">28</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="gambar_gigi1">
													<input type="checkbox" id="18" name="18" onclick="showDescOdontogram(18);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="17" name="17" onclick="showDescOdontogram(17);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="16" name="16" onclick="showDescOdontogram(16);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="15" name="15" onclick="showDescOdontogram(15);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="14" name="14" onclick="showDescOdontogram(14);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="13" name="13" onclick="showDescOdontogram(13);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="12" name="12" onclick="showDescOdontogram(12);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="11" name="11" onclick="showDescOdontogram(11);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="21" name="21" onclick="showDescOdontogram(21);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="22" name="22" onclick="showDescOdontogram(22);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="23" name="23" onclick="showDescOdontogram(23);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="24" name="24" onclick="showDescOdontogram(24);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="25" name="25" onclick="showDescOdontogram(25);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="26" name="26" onclick="showDescOdontogram(26);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="27" name="27" onclick="showDescOdontogram(27);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="28" name="28" onclick="showDescOdontogram(28);">
												</td>
											</tr>
										</tbody>
									</table>
								</div>

							</div>
							<div class="row-fluid">

								<div class="span8 offset2" style="text-align: center;">
									<table class="table" id="table_odontogram_2">
										<thead>
											<tr>
												<th style="text-align: center;">55</th>
												<th style="text-align: center;">54</th>
												<th style="text-align: center;">53</th>
												<th style="text-align: center;">52</th>
												<th style="text-align: center;">51</th>
												<th style="text-align: center;">61</th>
												<th style="text-align: center;">62</th>
												<th style="text-align: center;">63</th>
												<th style="text-align: center;">64</th>
												<th style="text-align: center;">65</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="gambar_gigi2">
													<input type="checkbox" id="55" name="55" onclick="showDescOdontogram(55);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="54" name="54" onclick="showDescOdontogram(54);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="53" name="53" onclick="showDescOdontogram(53);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="52" name="52" onclick="showDescOdontogram(52);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="51" name="51" onclick="showDescOdontogram(51);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="61" name="61" onclick="showDescOdontogram(61);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="62" name="62" onclick="showDescOdontogram(62);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="63" name="63" onclick="showDescOdontogram(63);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="64" name="64" onclick="showDescOdontogram(64);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="65" name="65" onclick="showDescOdontogram(65);">
												</td>
											</tr>
										</tbody>
									</table>
								</div>

							</div>
							<div class="row-fluid">

								<div class="span8 offset2" style="text-align: center;">
									<table class="table" id="table_odontogram_3">
										<tfoot>
											<tr>
												<th style="text-align: center;">85</th>
												<th style="text-align: center;">84</th>
												<th style="text-align: center;">83</th>
												<th style="text-align: center;">82</th>
												<th style="text-align: center;">81</th>
												<th style="text-align: center;">71</th>
												<th style="text-align: center;">72</th>
												<th style="text-align: center;">73</th>
												<th style="text-align: center;">74</th>
												<th style="text-align: center;">75</th>
											</tr>
										</tfoot>
										<tbody>
											<tr>
												<td class="gambar_gigi2">
													<input type="checkbox" id="85" name="85" onclick="showDescOdontogram(85);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="84" name="84" onclick="showDescOdontogram(84);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="83" name="83" onclick="showDescOdontogram(83);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="82" name="82" onclick="showDescOdontogram(82);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="81" name="81" onclick="showDescOdontogram(81);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="71" name="71" onclick="showDescOdontogram(71);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="72" name="72" onclick="showDescOdontogram(72);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="73" name="73" onclick="showDescOdontogram(73);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="74" name="74" onclick="showDescOdontogram(74);">
												</td>
												<td class="gambar_gigi2">
													<input type="checkbox" id="75" name="75" onclick="showDescOdontogram(75);">
												</td>
											</tr>
										</tbody>
									</table>
								</div>

							</div>
							<div class="row-fluid">

								<div class="span12" style="text-align: center;">
									<table class="table" id="table_odontogram_4">
										<tfoot>
											<tr>
												<th style="text-align: center;">48</th>
												<th style="text-align: center;">47</th>
												<th style="text-align: center;">46</th>
												<th style="text-align: center;">45</th>
												<th style="text-align: center;">44</th>
												<th style="text-align: center;">43</th>
												<th style="text-align: center;">42</th>
												<th style="text-align: center;">41</th>
												<th style="text-align: center;">31</th>
												<th style="text-align: center;">32</th>
												<th style="text-align: center;">33</th>
												<th style="text-align: center;">34</th>
												<th style="text-align: center;">35</th>
												<th style="text-align: center;">36</th>
												<th style="text-align: center;">37</th>
												<th style="text-align: center;">38</th>
											</tr>
										</tfoot>
										<tbody>
											<tr>
												<td class="gambar_gigi1">
													<input type="checkbox" id="48" name="48" onclick="showDescOdontogram(48);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="47" name="47" onclick="showDescOdontogram(47);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="46" name="46" onclick="showDescOdontogram(46);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="45" name="45" onclick="showDescOdontogram(45);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="44" name="44" onclick="showDescOdontogram(44);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="43" name="43" onclick="showDescOdontogram(43);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="42" name="42" onclick="showDescOdontogram(42);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="41" name="41" onclick="showDescOdontogram(41);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="31" name="31" onclick="showDescOdontogram(31);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="32" name="32" onclick="showDescOdontogram(32);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="33" name="33" onclick="showDescOdontogram(33);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="34" name="34" onclick="showDescOdontogram(34);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="35" name="35" onclick="showDescOdontogram(35);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="36" name="36" onclick="showDescOdontogram(36);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="37" name="37" onclick="showDescOdontogram(37);">
												</td>
												<td class="gambar_gigi1">
													<input type="checkbox" id="38" name="38" onclick="showDescOdontogram(38);">
												</td>
											</tr>
										</tbody>
									</table>
								</div>

							</div>

							<hr />

							<div class="row-fluid" id="desc_gigi">
								<div class="span3" style="text-align: center; display: none;" id="desc_18">
									<label>Gigi 18</label>
									<input type="text" placeholder="Type something…" name="desc18" id="desc18">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_17">
									<label>Gigi 17</label>
									<input type="text" placeholder="Type something…" name="desc17" id="desc17">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_16">
									<label>Gigi 16</label>
									<input type="text" placeholder="Type something…" name="desc16" id="desc16">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_15">
									<label>Gigi 15</label>
									<input type="text" placeholder="Type something…" name="desc15" id="desc15">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_14">
									<label>Gigi 14</label>
									<input type="text" placeholder="Type something…" name="desc14" id="desc14">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_13">
									<label>Gigi 13</label>
									<input type="text" placeholder="Type something…" name="desc13" id="desc13">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_12">
									<label>Gigi 12</label>
									<input type="text" placeholder="Type something…" name="desc12" id="desc12">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_11">
									<label>Gigi 11</label>
									<input type="text" placeholder="Type something…" name="desc11" id="desc11">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_21">
									<label>Gigi 21</label>
									<input type="text" placeholder="Type something…" name="desc21" id="desc21">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_22">
									<label>Gigi 22</label>
									<input type="text" placeholder="Type something…" name="desc22" id="desc22">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_23">
									<label>Gigi 23</label>
									<input type="text" placeholder="Type something…" name="desc23" id="desc23">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_24">
									<label>Gigi 24</label>
									<input type="text" placeholder="Type something…" name="desc24" id="desc24">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_25">
									<label>Gigi 25</label>
									<input type="text" placeholder="Type something…" name="desc25" id="desc25">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_26">
									<label>Gigi 26</label>
									<input type="text" placeholder="Type something…" name="desc26" id="desc26">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_27">
									<label>Gigi 27</label>
									<input type="text" placeholder="Type something…" name="desc27" id="desc27">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_28">
									<label>Gigi 28</label>
									<input type="text" placeholder="Type something…" name="desc28" id="desc28">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_55">
									<label>Gigi 55</label>
									<input type="text" placeholder="Type something…" name="desc55" id="desc55">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_54">
									<label>Gigi 54</label>
									<input type="text" placeholder="Type something…" name="desc54" id="desc54">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_53">
									<label>Gigi 53</label>
									<input type="text" placeholder="Type something…" name="desc53" id="desc53">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_52">
									<label>Gigi 52</label>
									<input type="text" placeholder="Type something…" name="desc52" id="desc52">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_51">
									<label>Gigi 51</label>
									<input type="text" placeholder="Type something…" name="desc51" id="desc51">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_61">
									<label>Gigi 61</label>
									<input type="text" placeholder="Type something…" name="desc61" id="desc61">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_62">
									<label>Gigi 62</label>
									<input type="text" placeholder="Type something…" name="desc62" id="desc62">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_63">
									<label>Gigi 63</label>
									<input type="text" placeholder="Type something…" name="desc63" id="desc63">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_64">
									<label>Gigi 64</label>
									<input type="text" placeholder="Type something…" name="desc64" id="desc64">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_65">
									<label>Gigi 65</label>
									<input type="text" placeholder="Type something…" name="desc65" id="desc65">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_85">
									<label>Gigi 85</label>
									<input type="text" placeholder="Type something…" name="desc85" id="desc85">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_84">
									<label>Gigi 84</label>
									<input type="text" placeholder="Type something…" name="desc84" id="desc84">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_83">
									<label>Gigi 83</label>
									<input type="text" placeholder="Type something…" name="desc83" id="desc83">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_82">
									<label>Gigi 82</label>
									<input type="text" placeholder="Type something…" name="desc82" id="desc82">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_81">
									<label>Gigi 81</label>
									<input type="text" placeholder="Type something…" name="desc81" id="desc81">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_71">
									<label>Gigi 71</label>
									<input type="text" placeholder="Type something…" name="desc71" id="desc71">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_72">
									<label>Gigi 72</label>
									<input type="text" placeholder="Type something…" name="desc72" id="desc72">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_73">
									<label>Gigi 73</label>
									<input type="text" placeholder="Type something…" name="desc73" id="desc73">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_74">
									<label>Gigi 74</label>
									<input type="text" placeholder="Type something…" name="desc72" id="desc72">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_75">
									<label>Gigi 75</label>
									<input type="text" placeholder="Type something…" name="desc75" id="desc75">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_48">
									<label>Gigi 48</label>
									<input type="text" placeholder="Type something…" name="desc48" id="desc48">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_47">
									<label>Gigi 47</label>
									<input type="text" placeholder="Type something…" name="desc47" id="desc47">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_46">
									<label>Gigi 46</label>
									<input type="text" placeholder="Type something…" name="desc46" id="desc46">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_45">
									<label>Gigi 45</label>
									<input type="text" placeholder="Type something…" name="desc45" id="desc45">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_44">
									<label>Gigi 44</label>
									<input type="text" placeholder="Type something…" name="desc44" id="desc44">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_43">
									<label>Gigi 43</label>
									<input type="text" placeholder="Type something…" name="desc43" id="desc43">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_42">
									<label>Gigi 42</label>
									<input type="text" placeholder="Type something…" name="desc42" id="desc42">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_41">
									<label>Gigi 41</label>
									<input type="text" placeholder="Type something…" name="desc41" id="desc41">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_31">
									<label>Gigi 31</label>
									<input type="text" placeholder="Type something…" name="desc31" id="desc31">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_32">
									<label>Gigi 32</label>
									<input type="text" placeholder="Type something…" name="desc32" id="desc32">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_33">
									<label>Gigi 33</label>
									<input type="text" placeholder="Type something…" name="desc33" id="desc33">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_34">
									<label>Gigi 34</label>
									<input type="text" placeholder="Type something…" name="desc34" id="desc34">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_35">
									<label>Gigi 35</label>
									<input type="text" placeholder="Type something…" name="desc35" id="desc35">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_36">
									<label>Gigi 36</label>
									<input type="text" placeholder="Type something…" name="desc36" id="desc36">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_37">
									<label>Gigi 37</label>
									<input type="text" placeholder="Type something…" name="desc37" id="desc37">
								</div>

								<div class="span3" style="text-align: center; display: none;" id="desc_38">
									<label>Gigi 38</label>
									<input type="text" placeholder="Type something…" name="desc38" id="desc38">
								</div>

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="row-fluid" id="section_services" style="display: none;">
			<div class="span12">
				<div class="block">
					<div class="navbar">
						<div class="navbar-inner">
							<h4>Services</h4>
						</div>
					</div>

					<div class="block-content">
						<div class="control-group">
							<label class="control-label" for="services_name">Services Name</label>
							<div class="controls">
								<select class="input-xxlarge" id="services_name" name="services_name">
									<option value="">Pick a Services</option>
									<?php
									if ($arr_services->num_rows() > 0) {
										foreach ($arr_services->result() as $key) {
											echo '<option value="' . $key->id_service . '">' . $key->group_desc . ' / ' . $key->serv_name . '</option>';
										}
									}
									?>
								</select>
							</div>
							<button type="button" class="btn btn-info" onclick="appendServices();">
								<i class="icon-plus"></i> Add Service
							</button>
						</div>

						<hr />

						<input type="hidden" id="count_service" value="0">
						<table class="table table-bordered table-stripped">
							<thead>
								<tr>
									<th>No</th>
									<th>Service Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="tbody_list_services">
								<tr>
									<td colspan="3" style="text-align: center;">-Services Empty-</td>
								</tr>
							</tbody>
						</table>

					</div>

					<div class="form-actions">
						<button type="button" class="btn btn-primary" id="submit_form">Submit</button>
						<button type="reset" class="btn">Reset</button>
					</div>

				</div>
			</div>
		</div>

	</form>
</div>

<div id="modal_list_registration" class="modal modal-large hide fade" tabindex="-1" role="dialog">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			<i class="icon-remove-sign"></i>
		</button>
		<h3>Find Data Registration</h3>
	</div>
	<div class="modal-body">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID Registration</th>
					<th>Register Date</th>
					<th>Name</th>
					<th>Date of Birth</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="tbody_list_registration"></tbody>
		</table>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>

<script src="<?= base_url(); ?>design/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>design/vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>design/assets/scripts.js"></script>
<script src="<?= base_url(); ?>design/assets/DT_bootstrap.js"></script>
<script src="<?= base_url(); ?>public/vendor/blockui/jquery.blockUI.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
	$(document).ready(function() {

		$('#button_registration_list').on('click', function(e) {
			e.preventDefault();
			let check = checkFormRegistrationList();

			if (check == true) {
				showSectionOdontogram();
				showSectionServices();
				truncateService();
				console.log('continue');
			}
		});

		$('#submit_form').on('click', function(e) {
			e.preventDefault();
			console.log('submit');

			let checkdontogram = checkOdontogram();

			if (checkdontogram == false) {
				swal("Oops!", "Please select at least one Odontogram", "warning", {
					buttons: false,
					timer: 3000,
				});
			} else {

				let countService = $('#count_service').val();
				if (countService == 0) {
					swal("Oops!", "Please select at least one Service", "warning", {
						buttons: false,
						timer: 3000,
					});
				} else {
					$.ajax({
						url: '<?= site_url(); ?>docter/save_doctor_order_ajax',
						method: 'post',
						dataType: 'json',
						data: $('#form_doctor_order').serialize(),
						beforeSend: function(e) {
							$.blockUI();
						}
					}).always(function(e) {
						$.unblockUI();
					}).fail(function(e) {
						console.log(e);
					}).done(function(e) {
						console.log(e);
						if (e.code == 500 || e.code == 404) {
							swal("Oops!", e.msg, "warning", {
								buttons: false,
								timer: 3000,
							});
						} else if (e.code == 200) {
							swal("Success!", e.msg, "success", {
								buttons: false,
								timer: 3000,
							}).then((res) => {
								location.reload();
							});
						}
					});
				}

			}

		})

	});

	function truncateService() {
		let id_registration = $('#id_registration').val();
		let id_patient = $('#id_patient').val();
		$.ajax({
			url: '<?= site_url(); ?>docter/truncate_list_services',
			method: 'post',
			dataType: 'json',
			data: {
				id_registration: id_registration,
				id_patient: id_patient,
			},
			beforeSend: function(e) {
				$.blockUI();
			}
		}).always(function(e) {
			$.unblockUI();
		}).fail(function(e) {
			console.log(e);
		}).done(function(e) {
			console.log(e);
		});
	}

	function showModalListRegistration() {
		$.ajax({
			url: '<?= site_url('regreport/get_list_registration'); ?>',
			method: 'get',
			dataType: 'json',
			beforeSend: function() {
				$.blockUI();
			}
		}).always(function() {
			$.unblockUI();
		}).fail(function(e) {
			console.log(e);
		}).done(function(e) {
			console.log(e);
			if (e.code == 500) {
				swal({
					title: "Oops!",
					text: "Failed to get Registration Data. Contact Web Developer",
					icon: "warning",
					buttons: false,
					timer: 3000,
				}).then((res) => {
					//
				});
			} else if (e.code == 200) {
				let htmlnya = ``;

				if (e.num_rows > 0) {
					$.each(e.result, function(i, k) {
						htmlnya += `
						<tr>
							<td>${k.id_reg}</td>
							<td>${k.reg_date}</td>
							<td>${k.pat_name}, ${k.title_desc}</td>
							<td>${k.pat_dob}</td>
							<td>
								<button type="button" class="btn btn-success" onclick="selectDataRegistration('${k.id_reg}', '${k.id_pat}', '${k.pat_name}', '${k.title_desc}', '${k.age}', '${k.price_type}')">
									<i class="icon-plus-sign"></i>
								</button>
							</td>
						</tr>
						`;
					});
				} else {
					htmlnya = `
					<tr>
						<td colspan="5" style="text-align: center; font-weight: bold; color: red;">Data Empty</td>
					</tr>
					`;
				}
				$('#tbody_list_registration').html(htmlnya);
				$('#modal_list_registration').modal({
					show: true,
					backdrop: true
				});
			}
		});
	}

	function selectDataRegistration(id_reg, id_pat, pat_name, title_desc, age, price_type) {
		$('#id_registration').val(id_reg);
		$('#id_patient').val(id_pat);
		$('#patient_name').val(`${pat_name}, ${title_desc}`);
		$('#charge_rule').val(price_type);
		$('#age').val(age);
		$('#modal_list_registration').modal('hide');
	}

	function checkFormRegistrationList() {
		let stat = true;
		if ($('#id_registration').val().length == 0) {
			swal("Oops!", "ID Registration Empty", "info", {
				buttons: false,
				timer: 3000,
			});
			stat = false;
		} else if ($('#patient_name').val().length == 0) {
			swal("Oops!", "Patient Name Empty", "info", {
				buttons: false,
				timer: 3000,
			});
			stat = false;
		} else if ($('#charge_rule').val().length == 0) {
			swal("Oops!", "Charge Rule Empty", "info", {
				buttons: false,
				timer: 3000,
			});
			stat = false;
		} else if ($('#age').val().length == 0) {
			swal("Oops!", "Age Empty", "info", {
				buttons: false,
				timer: 3000,
			});
			stat = false;
		}

		return stat;
	}

	function showSectionOdontogram() {
		$('#section_odontogram').fadeIn();
	}

	function showDescOdontogram(num) {
		selector = $(`#${num}:checked`);
		if (selector.val() == "on") {
			$(`#desc_${num}`).fadeIn().val();
		} else {
			$(`#desc_${num}`).fadeOut().val();
		}
	}

	function showSectionServices() {
		$('#section_services').fadeIn();
	}

	function appendServices() {
		let id_registration = $('#id_registration').val();
		let id_patient = $('#id_patient').val();
		let id_service = $('#services_name').val();

		if (id_service == "") {
			swal("Oops!", "Please Choose One Service to be Add", "info", {
				buttons: false,
				timer: 3000,
			});
		} else {
			$.ajax({
				url: '<?= site_url(); ?>docter/append_services',
				method: 'post',
				dataType: 'json',
				data: {
					id_registration: id_registration,
					id_patient: id_patient,
					id_service: id_service,
				},
				beforeSend: function(e) {
					$.blockUI();
				}
			}).always(function(e) {
				$.unblockUI();
			}).fail(function(e) {
				console.log(e);
			}).done(function(e) {
				if (e.code == 500) {
					swal("Oops!", e.msg, "info", {
						buttons: false,
						timer: 3000,
					});
				} else if (e.code == 200) {
					swal("Success!", e.msg, "success", {
						buttons: false,
						timer: 3000,
					}).then((res) => {
						let count = $('#count_service').val();
						let newCount = parseInt(count + 1);
						$('#count_service').val(newCount);
						updateTableListService();
					});
				}
			});
		}
	}

	function updateTableListService() {
		$.ajax({
			url: '<?= site_url(); ?>docter/get_table_list_service',
			method: 'get',
			dataType: 'json',
			data: {
				id_registration: $('#id_registration').val(),
				id_patient: $('#id_patient').val(),
			},
			beforeSend: function(e) {
				$.blockUI();
			}
		}).always(function(e) {
			$.unblockUI();
		}).fail(function(e) {
			console.log(e);
		}).done(function(e) {
			if (e.code == 500) {
				swal("Oops!", "Failed to get list services, please contact Web Admin", "error", {
					buttons: false,
					timer: 3000,
				});
			} else if (e.code == 200) {
				let html = '';

				if (e.num_rows == 0) {
					html += `
					<tr>
						<td colspan="3" style="text-align: center;">-Services Empty-</td>
					</tr>
					`;
				} else {
					let no = 1;
					$.each(e.result, function(i, k) {
						let button_remove = `
						<button type="button" class="btn btn-danger" onclick="removeService('${k.id}');">
							<i class="icon-remove-sign"></i> Remove
						</button>
						`;
						html += `
						<tr>
							<td style="text-align: center;">${no}</td>
							<td>${k.group_desc} / ${k.service_name}</td>
							<td>${button_remove}</td>
						</tr>
						`;
						no++;
					});
				}

				$('#tbody_list_services').html(html);
				console.log("table list services updated");
			}
		});
	}

	function removeService(id) {
		let id_registration = $('#id_registration').val();
		let id_patient = $('#id_patient').val();

		$.ajax({
			url: '<?= site_url(); ?>docter/remove_services',
			method: 'post',
			dataType: 'json',
			data: {
				id: id,
			},
			beforeSend: function(e) {
				$.blockUI();
			}
		}).always(function(e) {
			$.unblockUI();
		}).fail(function(e) {
			console.log(e);
		}).done(function(e) {
			if (e.code == 404 || e.code == 500) {
				swal("Oops!", e.msg, "info", {
					buttons: false,
					timer: 3000,
				});
			} else if (e.code == 200) {
				swal("Success!", e.msg, "success", {
					buttons: false,
					timer: 3000,
				}).then((res) => {
					let count = $('#count_service').val();
					let newCount = parseInt(count - 1);
					$('#count_service').val(newCount);
					updateTableListService();
				});
			}
		});
	}

	function checkOdontogram() {
		let arrayOdontogram = [
			18, 17, 16, 15, 14, 13, 12, 11, 21, 22, 23, 24, 25, 26, 27, 28,
			55, 54, 53, 52, 51, 61, 62, 63, 64, 65,
			85, 84, 83, 82, 81, 71, 72, 73, 74, 75,
			48, 47, 46, 45, 44, 43, 42, 41, 31, 32, 33, 34, 35, 36, 37, 38
		];

		let count = 0;
		for (a = 0; a < arrayOdontogram.length; a++) {
			if ($(`#${arrayOdontogram[a]}:checked`).val() == "on") {
				count++;
			}
		}

		if (count == 0) {
			console.log(false);
			return false;
		}

		console.log(true);
		return true;
	}
</script>