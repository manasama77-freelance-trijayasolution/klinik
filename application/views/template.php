<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html class="no-js">
<?php
$kb=1024;
flush();
$time = explode(" ",microtime());
$start = $time[0] + $time[1];
for($x=0;$x<$kb;$x++){
    flush();
}
$time = explode(" ",microtime());
$finish = $time[0] + $time[1];
$deltat = $finish - $start;
$session_data 	= $this->session->userdata('logged_in');
$jobs 			= $session_data['jobs'];
$userlevel		= $session_data['userlevel'];
$id		        = $session_data['id'];

$ats1		        = $session_data['ats1'];
$ats2		        = $session_data['ats2'];
$ats3		        = $session_data['ats3'];
date_default_timezone_set('Asia/Jakarta');
function time_elapsed_string($datetime, $full = false){
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

	include './design/koneksi/file.php';
	//echo "<script>if (!window.console) console = {};console.info = console.info('Ready to serve, sir... (check error below)') || function(){};</script>";
	$con		=mysqli_connect($host, $user, $pass, $database);
	$query 		="SELECT * FROM pat_order_h inner join pat_data on pat_data.id_Pat=pat_order_h.id_pat where order_status=2 and order_type=2 ORDER BY order_date DESC";  
	if($result 	=mysqli_query($con, $query)){}
	
	$query2 	="SELECT * FROM trx_item_pr_h where dept_id='".$jobs."' and is_finalized='1' ";  
	if($result2 =mysqli_query($con, $query2)){}
	
	$query3 	="SELECT * FROM trx_item_po_h inner join mst_user on mst_user.id=trx_item_po_h.user_id where menu_level='".$jobs."' and is_completed='1' ";  
	if($result3 =mysqli_query($con, $query3)){}
	
	$query4 	="SELECT * FROM mst_user where online='1'";  
	if($result4 =mysqli_query($con, $query4)){}
	$nums		=mysqli_num_rows($result4);

    $query5     ="SELECT * FROM trx_item_transfer_h where from_dept='".$jobs."' and is_finalized='1' ";  
    if($result5 =mysqli_query($con, $query5)){}
	
	$query6     ="SELECT id,id_reg,notes,create_date,serv_name,price_type,type_id
		FROM smart_notification a
		INNER JOIN mst_services b ON a.`type_id`=b.`id_group_serv` AND a.`id_trouble`=b.`id_service`
		INNER JOIN mst_price_type c ON a.`id_source_trouble`=c.`id_price_type`
		WHERE type_id = '0' AND id_department LIKE '%".$jobs."%' and status = '1'
		UNION ALL
		SELECT id,id_reg,notes,create_date,serv_name,price_type,type_id
		FROM smart_notification a
		INNER JOIN mst_services b ON a.`type_id`=b.`id_group_serv` AND a.`id_trouble`=b.`order_id`
		INNER JOIN mst_price_type c ON a.`id_source_trouble`=c.`id_price_type`
		WHERE type_id = '1' AND id_department LIKE '%".$jobs."%' and status = '1'
		UNION ALL
		SELECT id,id_reg,notes,create_date,serv_name,price_type,type_id
		FROM smart_notification a
		INNER JOIN mst_services b ON a.`type_id`=b.`id_group_serv` AND a.`id_trouble`=b.`order_id`
		INNER JOIN mst_price_type c ON a.`id_source_trouble`=c.`id_price_type`
		WHERE type_id = '2' AND id_department LIKE '%".$jobs."%' and status = '1'
		UNION ALL
		SELECT id,id_reg,notes,create_date,serv_name,price_type,type_id
		FROM smart_notification a
		INNER JOIN mst_services b ON a.`type_id`=b.`id_group_serv` AND a.`id_trouble`=b.`id_service`
		INNER JOIN mst_price_type c ON a.`id_source_trouble`=c.`id_price_type`
		WHERE type_id = '3' AND id_department LIKE '%".$jobs."%' and status = '1'
		UNION ALL
		SELECT id,id_reg,notes,create_date,serv_name,price_type,type_id
		FROM smart_notification a
		INNER JOIN mst_services b ON a.`type_id`=b.`id_group_serv` AND a.`id_trouble`=b.`id_service`
		INNER JOIN mst_price_type c ON a.`id_source_trouble`=c.`id_price_type`
		WHERE type_id = '4' AND id_department LIKE '%".$jobs."%' and status = '1'
		UNION ALL
		SELECT id,id_reg,notes,create_date,serv_name,price_type,type_id
		FROM smart_notification a
		INNER JOIN mst_services b ON a.`type_id`=b.`id_group_serv` AND a.`id_trouble`=b.`id_service`
		INNER JOIN mst_price_type c ON a.`id_source_trouble`=c.`id_price_type`
		WHERE type_id = '5' AND id_department LIKE '%".$jobs."%' and status = '1'
        UNION ALL
        SELECT id,id_reg,notes,a.create_date,item_name,price_type,type_id
        FROM smart_notification a
        INNER JOIN mst_item b ON a.`type_id`=13 AND a.`id_trouble`=b.`id_item`
        INNER JOIN mst_price_type c ON a.`id_source_trouble`=c.`id_price_type`
        WHERE  id_department LIKE '%".$jobs."%' and status = '1'";  
    if($result6 =mysqli_query($con, $query6)){}
	
	$query7     ="SELECT * FROM mkt_quotation_h inner join mst_user on mst_user.id=mkt_quotation_h.mkt_id where is_finalised='1' and atasan_1='".$id."'";  
	//echo 	$query7;
    if($result7 =mysqli_query($con, $query7)){}

    $query8     ="SELECT * FROM trx_item_request_h WHERE is_complete='0' ";  
    if($result8 =mysqli_query($con, $query8)){}

    $query9     ="SELECT * FROM trx_item_transfer_h WHERE is_finalized='0' AND from_dept LIKE '%".$jobs."%'; ";  
    // $query9     ="SELECT * FROM smart_notification WHERE notes='Transfer Items' AND status='0' AND id_department LIKE '%".$jobs."%'; ";  
    if($result9 =mysqli_query($con, $query9)){}

    $query10    ="SELECT * FROM mst_item WHERE is_active=2;";
    if($result10 =mysqli_query($con, $query10)){}


    
?>    
    <head>
        <title><?php echo $title;?></title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url();?>design/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>design/assets/styles.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url();?>design/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<!-- zWeatherFeed plugin scripts (required) -->
		<script src="<?php echo base_url();?>design/cuaca/jquery.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>design/cuaca/jquery.zweatherfeed.min.js" type="text/javascript"></script>
		<link href="<?php echo base_url();?>design/cuaca/example.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo base_url();?>design/tick/ticker.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/tick/ticker.css">
		<link href="<?php echo base_url();?>design/assets/jquerysctipttop.css" rel="stylesheet" type="text/css">
    </head>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
}
</script>

<body>
	<?php
	$link 		= $this->uri->segment(2);
	$url 		= $this->uri->segment(1);
	$outlink	=	substr($link, 0,4);
	$outlink2	=	substr($link, 4,3);
	$outlink3	=	substr($link, 8,3);
	$url 		= $this->uri->segment(1);
	if($url=="home"){	
		$logic 		="update mst_user set online=1 where id='$id' ";  
	   if($hasil 	=mysqli_query($con, $logic)){}
	}else{
		if($url=="home"){	
		$logic 		="update mst_user set online=1 where id='$id' ";  
	   if($hasil 	=mysqli_query($con, $logic)){}
		}else{
    	$logic 		="update mst_user set online=0 where id='$id' ";  
    	if($hasil 	=mysqli_query($con, $logic)){}
    		}
	} 
        
    if ($link == "input_result_act" || $link == "mark_sheet_mcu_act") {
        #agar tidak di lock..      
    }else{
        $lock_nurse ="update pat_ms_h set locked=0, lock_by=0 where lock_by='$id' ";  
        if($hasil   =mysqli_query($con, $lock_nurse)){}
    
        $lock_dokter ="update pat_mcu_result set locked=0, lock_by=0 where lock_by='$id' ";  
        if($hasil   =mysqli_query($con, $lock_dokter)){}
    }

	// echo $link." - ".$outlink." - ".$outlink2." - ".$outlink3;
	if ($link != "list_detail_prescription" && $link != "list_detail_manufaktur" && $link != "list_detail_package" && $link != "transfer_items_warehouse" && $link != "inv_item_warehouse" && $outlink != "find" && $outlink2 != "act" && $outlink2 != "_se" && $outlink2 != "app" && $link != "app_one" && $outlink2 != "k_r" && $outlink2 != "te_" && $outlink3 != "eri" && $outlink2 != "edi" && $outlink2 != "ret" && $outlink2 != "upd" && $outlink3 != "_pr" && $outlink != "chat" && $outlink2 !="_ot" && $link != "list_billing" && $link != "list_billing2" && $link != "list_detail_quotation" && $link != "step_2" && $link != "list_detail_quotation_app" && $link != "print_eticket" && $link != "price_n"  && $link != "price_n2" && $link != "returnt_items_detail" && $link != "lab_rev" && $link != "list_detail_quotation_view" && $link != "price_lab" && $link != "price_other"  && $link != "detail_client" && $link != "detail_insurance" && $link != "trf_item_app" && $link != "trf_item_app_reject" && $link != "list_item_price" && $link != "list_inv_item" && $link != "list_item_value" && $link != "change_range" && $link != "list_item_value_input" && $link != "add_new_sysparam" && $link != "add_sysparam"  && $link != "registration_update"  && $link != "add_service_price" && $link != "rad_rev" && $link != "list_lab_item" && $link != "add_notes"  && $link != "new_lab_item" && $outlink != "add_" && $outlink != "view" && $link != "app_item_request" ){ 
	?> 
        <div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a><a class="brand" href="#">KLINIK </a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?php echo ucwords($username); ?><i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>user/edit/<?php echo ucwords($id);?>"><i class="icon-list"></i> Profile</a>
                                    </li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/purchase_req"><i class="icon-shopping-cart"></i> Purchase Request</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/transfer_items_request"><i class="icon-shopping-cart"></i> Item Request</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>smart/list_notif"><i class="icon-bullhorn"></i> List Notification </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#"><i class="icon-question-sign"></i> Support Center</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>smart/list_notif"><i class="icon-list"></i> List Notification</a>
                                    </li>
                                    <li class="divider"></li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>f_home/"> <i class=" icon-briefcase"></i> Admin Area</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>home/logout"> <i class=" icon-off"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="">
                                <a href="<?php echo base_url();?>home">Dashboard</a>
                            </li>
							<?php
                            /** 
                            2, ADMIN, admin, 
                            3, DOKTER, dokter, 
                            4, NURSE, nurse, 
                            5, MARKETING, marketing, 
                            6, LAB, lab, 
                            7, RADIOLOGI, radiologi, 
                            8, GA, ga, 
                            9, APOTEK, apotek, 
                            10, FISIOTERAPI, fisioterapi, 
                            11, CLINIQUE.SUISSE, cs, 
                            12, HR & IT, hrit, 
                            13, BUSINESS DEVELOPMENT, bd, 
                            14, FRONT OFFICE, FO, 
                            **/

							if ($jobs==4 || $jobs==3 || $userlevel=="master"){ ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Check up <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                <?php if ($jobs==3 || $userlevel=="master"){ ?>

									<li>
                                        <a href="<?php echo base_url();?>patient/input_result"><i class="icon-edit"></i> Check Up Result <font color='blue'><b>(Doctor)</b></font>
                                        </a>
                                    </li>
									<li>
                                        <a href="<?php echo base_url();?>patient/input_result_dental"><i class="icon-edit"></i> Dental Result <font color='blue'><b>(Doctor)</b></font>
                                        </a>
                                    </li>
                                    <?php } ?>
									<li>
                                        <a href="<?php echo base_url();?>patient/mark_sheet_mcu"><i class="icon-file"></i> Marking Sheet <font color='red'><b>(Nurse)</b></font>
                                        </a>
                                    </li>
									<li>
                                        <a href="<?php echo base_url();?>patient/upload_img"><i class="icon-upload"></i> Upload Attch.
                                        </a>
                                    </li>
									<li class="divider"></li>
									<li>
                                        <a href="<?php echo base_url();?>patient/print_label"><i class="icon-print"></i> Print MCU Label
                                        </a>
                                    </li>
									<li>
                                        <a href="<?php echo base_url();?>patient/print_mcu"><i class="icon-print"></i> Print MCU Result
                                        </a>
                                    </li>
                                </ul>
                            </li>
							<?php } ?>
							<?php
							if ($jobs==4 || $jobs==14 || $jobs==2 || $userlevel=="master"){ ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Patient <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" id="menu1">
									<li>
                                        <a href="<?php echo base_url();?>registration/reg_patien"><i class="icon-plus-sign"></i> New Registration
                                        <!-- <a href="<?php echo base_url();?>registration/reg_patien"><i class="icon-tasks"></i> Registration -->
                                        </a>
                                    </li>
									<!--<li><a href="<?php echo base_url();?>registration/add_order">Additional Orders</a></li>-->
									<li>
                                        <a href="<?php echo base_url();?>patient/data_patient"><i class="icon-plus-sign"></i> New Patient
                                        </a>
                                    </li>
                                    
									<!--
                                    <li>
                                        <a href="<?php echo base_url();?>client/new_company"><i class="icon-plus-sign"></i> New Company
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>client/add_insurance"><i class="icon-plus-sign"></i> New Insurance
                                        </a>
                                    </li>
									<li>
                                        <a href="<?php echo base_url();?>patient/quesioner_patient_mcu">Questionnaire
                                        </a>
                                    </li>
									-->
									<li class="divider"></li>
									<li>
                                        <a href="<?php echo base_url();?>regreport/reg_report"><i class="icon-list-alt"></i> Data Registration</a>
                                    </li>
									<li>
                                        <a href="<?php echo base_url();?>patient/list_patient"><i class="icon-list-alt"></i> Data Patient</a>
                                    </li>
									<!--
                                    <li>
                                        <a href="<?php echo base_url();?>client/list_company"><i class="icon-list-alt"></i> Data Company</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>docter/doctor_order_list/#1"><i class="icon-list-alt"></i> Doctor Order List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>patient/print_label"><i class="icon-print"></i> Print MCU Label
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>patient/print_mcu"><i class="icon-print"></i> Print MCU Result
                                        </a>
                                    </li>
									<li>
                                        <a href="<?php echo base_url();?>patient/mrn_patien">Medical Record Patient
                                        </a>
                                    </li>	
									-->									
                                </ul>
                            </li>
							<?php } ?>
							<?php
							if ($jobs==3 || $jobs==2 || $userlevel=="master"){ 
							?>
							<li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Doctor <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="<?php echo base_url();?>docter/docter_order/"><i class="icon-inbox"></i> Doctor Order</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>docter/doctor_order_list/#1"><i class="icon-list-alt"></i> Doctor Order List</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/mst_service"><i class="icon-folder-open"></i> Master Services </a>
                                    </li>
                                    

                                    <!-- Buka pembatas
                                                            
								    <li>
                                        <a href="<?php echo base_url();?>docter/doctor_dental/#1">Doctor Dental Order List
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo base_url();?>docter/doctor_order_report/#1">Doctor Order Report
                                        </a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a href="<?php echo base_url();?>docter/mst_item_value/"><i class="icon-folder-open"></i> Master Item Value
                                        </a>
                                    </li>
									
									<li>
                                        <a href="<?php echo base_url();?>docter/emr">e-MR (Medical Record)
                                        </a>
                                    </li>

                                    <li class="divider"></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>docter/report_mcu_list"><i class="icon-file"></i> Report MCU </a></li>
									
                                    Tutup pembatas -->

                                </ul>
                            </li>

    <?php } if ($jobs==5 || $jobs==13 || $userlevel=="master"){ ?>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Marketing <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/mst_service_package"><i class="icon-plus-sign"></i> New Services Package</a>
                                    </li>         
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/quotation_v1"><i class="icon-plus-sign"></i> New Quotation V1</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/quotation"><i class="icon-plus-sign"></i> New Quotation V2</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>marketing/order_form"><i class="icon-plus-sign"></i> Add Order Form
                                        </a>
                                    </li>       
                                    <li>
                                        <a href="<?php echo base_url();?>marketing/sales_contract"><i class="icon-plus-sign"></i> Add Sales Contract
                                        </a>
                                    </li>       
                                    <li>
                                        <a href="<?php echo base_url();?>client/add_client"><i class="icon-plus-sign"></i> New Company
                                        </a>
                                    </li>       
                                    <li class="divider"></li>
                        <?php if ($userlevel=="master" || $userlevel=="supervisor"){ ?>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/mst_service"><i class="icon-folder-open"></i> Master Services <b>(Price)</b></a>
                                    </li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/mst_grouping_items"><i class="icon-folder-open"></i> Master Grouping Items</a>
                                    </li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/mst_currency"><i class="icon-folder-open"></i> Master Currency</a>
                                        <!-- <a tabindex="-1" href="#" onclick="mst_curr()"> Master Currency</a> -->
                                    </li>
                                    <li class="divider"></li>
                        <?php } ?>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/list_package"><i class="icon-list"></i> My Services Package</a>
                                    </li>    
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/list_quotation"><i class="icon-list"></i> My Quotation</a>
                                    </li>    
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/my_order_form"><i class="icon-list"></i> My Order Form</a>
                                    </li>    
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/my_sales_contract"><i class="icon-list"></i> My Sales Contract</a>
                                    </li>         
                                    <!-- <?php if ($userlevel=="master" || $userlevel=="supervisor"){ ?>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/list_service" target="_blank"><i class="icon-list"></i> List Services Price</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/list_service_price" target="_blank"><i class="icon-list"></i> List Services Price By Group</a>
                                    </li>
                                    <?php } ?> -->
                                </ul>
                            </li>
	<?php } if ($jobs==6 || $userlevel=="master"){ ?>
							<li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Lab <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
								
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>lab/order_lab"><i class="icon-plus-sign"></i> Lab Order</a>
                                    </li>
								
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>lab/lab_job/1"><i class="icon-inbox"></i> Lab Order List</a>
                                    </li>
									<li class="divider"></li>
									
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>lab/mst_lab_group"><i class="icon-folder-open"></i> Master Lab Group</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>Lab/mst_lab_item"><i class="icon-folder-open"></i> Master Lab Item</a>
                                    </li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>Lab/mst_lab_range"><i class="icon-folder-open"></i> Master Lab Range</a>
                                    </li>
                                    <li class="divider"></li>
                                     <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>Lab/list_lab_item" target="_blank"><i class="icon-list-alt"></i> List Lab Item</a>
                                    </li>
									<!--
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>Lab/group_item_lab"> Grouping Item Lab</a>
                                    </li>
									-->
                                </ul>
                            </li>
    <?php } if ($jobs==7 || $userlevel=="master"){ ?>
							<li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Radiology - USG<i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
								
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>radiology/order_radiology"><i class="icon-plus-sign"></i> Radiology Order</a>
                                    </li>
								
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>radiology/radiology_job/1"><i class="icon-inbox"></i> Radiology Order List</a>
                                    </li>
									<!--
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>radiology/rad_report_order/1"> Report Order</a>
                                    </li>
									-->
									<li class="divider"></li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>radiology/input_radiology_group"><i class="icon-folder-open"></i> Master Radiology Group</a>
                                    </li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>radiology/input_radiology_items"><i class="icon-folder-open"></i> Master Radiology Item</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>docter/mst_item_value/"><i class="icon-folder-open"></i> Master Item Value
                                        </a>
                                    </li>
                                </ul>
                            </li>
							<?php } ?>
							<?php
							if ($userlevel=="master"){ 
							?>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Inventory <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">								
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/purchase_req"><i class="icon-shopping-cart"></i> Purchase Request</a>
                                    </li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/purchase_order"><i class="icon-shopping-cart"></i> Purchase Order</a>
                                    </li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/received_items"><i class="icon-download-alt"></i> Received Items / Return</a>
                                    </li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/transfer_items"><i class="icon-retweet"></i> Transfer Items</a>
                                    </li>
									<li class="divider"></li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/inv_delivery"><i class="icon-folder-open"></i> Master Delivery Address</a>
                                    </li>
									<li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/inv_warehouse"><i class="icon-folder-open"></i> Master Warehouse</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/inv_item"><i class="icon-folder-open"></i> Master Item</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/inv_item_group"><i class="icon-folder-open"></i> Master Item Group</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/inv_supplier"><i class="icon-folder-open"></i> Master Supplier</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/inv_conversion"><i class="icon-folder-open"></i> Master Conversion</a>
                                    </li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>inv/inv_coa"><i class="icon-folder-open"></i> Master COA</a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>inv/inv_group_coa"><i class="icon-folder-open"></i> Master Type COA</a></li>


                                    <!--
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/inv_limit">Master Limit</a>
                                    </li>
                                    -->
                                    

                                    <!-- <li class="divider"></li> -->

                                </ul>
                            </li>

<!-- 
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">General Ledger<i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">                              
                                    <li>
                                        <a tabindex="-1" href="#">Journal List</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Process Menu</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Report Menu</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Maintance Menu</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Ultility Menu</a>
                                    </li>
                                </ul>
                            </li>
-->                            
							<?php } ?>
							<?php
                            if ($jobs==9 || $userlevel=="master"){ 
                            ?>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Pharmacy<i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
								
                                    <li><a tabindex="-1" href="<?php echo base_url();?>Pharmacy/Prescription_order"><i class="icon-inbox"></i> Prescription Order </a></li>
								
                                    <li><a tabindex="-1" href="<?php echo base_url();?>Pharmacy/list_prescription"><i class="icon-check"></i> Prescription Order List </a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>Pharmacy/list_manufaktur"><i class="icon-list-alt"></i> List Manufacture </a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>Pharmacy/add_eticket"><i class="icon-print"></i> E-Ticket </a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>Pharmacy/returnt_items"><i class=" icon-refresh"></i> Returnt Items / Drugs </a></li>
                                    <li class="divider"></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>Pharmacy/add_manufaktur"><i class="icon-folder-open"></i> Master Manufacture </a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>Pharmacy/add_label"><i class="icon-folder-open"></i> Master Label </a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>Pharmacy/add_dosage"><i class="icon-folder-open"></i> Master Dosage </a></li>
                                    <!-- <li class="divider"></li> -->
                                    <!-- <li><a tabindex="-1" href="<?php echo base_url();?>Pharmacy/report_prescription"><i class="icon-file"></i> Prescription Report </a></li> -->

                                </ul>
                            </li>
                            <?php } ?>
                            <?php 
                            if ($jobs==14 || $jobs==2 || $userlevel=="master"){ 
                            ?>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Cashier<i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="<?php echo base_url();?>cashier/input_billing"><i class="icon-bold"></i> Bill To Patient</a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>cashier/payment_list"><i class="icon-barcode"></i> Patient PayToday</a></li>
                                    
                                    <!--
                                    <li><a tabindex="-1" href="<?php echo base_url();?>cashier/counter">Counter</a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>cashier/doctor_fee">Doctor Fee</a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>cashier/invoice_list"><i class="icon-print"></i> Invoice & Official Receipt</a></li>
                                    -->
                                    <!-- <li class="divider"></li> -->

                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Report<i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="<?php echo base_url();?>cashier/report_patient"><i class="icon-circle-arrow-down"></i> Patient </a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>cashier/report_expense"><i class="icon-circle-arrow-down"></i> Expense </a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url();?>cashier/report_profit"><i class="icon-circle-arrow-down"></i> Profit </a></li>
                                    <!-- 
                                    <li class="divider"></li> 
                                    <li><a tabindex="-1" href="<?php echo base_url();?>cashier/report_income"><i class="icon-circle-arrow-down"></i> Income </a></li>
                                    -->

                                </ul>
                            </li>

                            <?php } 
                            if ($userlevel=="ks"){ 
                            ?>
                                                        <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Kelapa Sawit <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>user/list_us"><i class="icon-list"></i> List User </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>master/list_kriteria"><i class="icon-list"></i> List Kriteria</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>master/list_service_bahasa" target="_blank"><i class="icon-book"></i> Transaksi</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>master/sys_result" target="_blank"><i class="icon-wrench"></i> Laporan</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>master/log_user"><i class="icon-info-sign"></i> Log Sistem </a>
                                    </li>
                                    

                                    <li class="divider"></li>

                                    <li>
                                        <a tabindex="-1" href="#"> Patien </a>
                                    </li>                                    
                                    <li>
                                        <a href="<?php echo base_url();?>patient/fo_report"><i class="icon-user"></i> Report FO</a>
                                    </li>
                                    
                                </ul>
                            </li>


                            <?php } 
                            if ($userlevel=="master"){ 
                            ?>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Master <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>user/list_us"><i class="icon-list"></i> List User </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>master/list_sysparam"><i class="icon-list"></i> List Parameter</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>master/list_service_bahasa" target="_blank"><i class="icon-book"></i> Update Language</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>master/sys_result" target="_blank"><i class="icon-wrench"></i> Sys Result</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>master/log_user"><i class="icon-info-sign"></i> Log Sistem </a>
                                    </li>
                                    

                                    <li class="divider"></li>

                                    <li>
                                        <a tabindex="-1" href="#"> Patien </a>
                                    </li>                                    
                                    <li>
                                        <a href="<?php echo base_url();?>patient/fo_report"><i class="icon-user"></i> Report FO</a>
                                    </li>



                                    <li class="divider"></li>




                                    <li>
                                        <a tabindex="-1" href="#"> Marketing </a>
                                    </li>    
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/list_quotation_all/1"><i class="icon-list"></i> List Quotation</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/list_service" target="_blank"><i class="icon-list"></i> List Services Price</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/list_service_price" target="_blank"><i class="icon-list"></i> List Services Price By Group</a>
                                    </li>



                                    <li class="divider"></li>




                                    <li>
                                        <a tabindex="-1" href="#"> Inventory </a>
                                    </li>    
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/listpr_app_all"><i class="icon-list"></i> List Purchase Request</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/list_inv_item" target="_blank" ><i class="icon-list"></i> List Items </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/list_item_price" target="_blank" ><i class="icon-list"></i> List Items Price </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/list_service" target="_blank"><i class="icon-list"></i> List Services Price</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/list_inv_item_request"><i class="icon-list"></i> Request Items </a>
                                    </li> 
                                   <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>marketing/list_service_price" target="_blank"><i class="icon-list"></i> Services Price</a>
                                    </li>

                                    <!-- 
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/list_request_items"><i class="icon-list"></i> Request Items List</a>
                                    </li> 
                                    <li>
                                        <a tabindex="-1" href="<?php echo base_url();?>inv/list_inv_item_request" target="_blank" ><i class="icon-list"></i> List Items Request </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Search</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Permissions</a>
                                    </li>
                                    -->
                                    
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
			<?php 
            if ($userlevel == "master" && mysqli_num_rows($result10) != 0) {
                $jumlah10 = mysqli_num_rows($result10);
            }else{
                $jumlah10 = 0;
            }
            if(mysqli_num_rows($result2) != 0 || mysqli_num_rows($result5) != 0 || mysqli_num_rows($result6) != 0 || mysqli_num_rows($result7) != 0 || mysqli_num_rows($result8) != 0 || mysqli_num_rows($result9) != 0 || $jumlah10 != 0
                 // || mysqli_num_rows($result3) != 0
                 ) 
			{
			?>
			<div class="ticker-container">
				<div class="ticker-caption">
				<?php if ($jobs==6){ ?>
				<p>Notification <span class="badge badge-inverse"><a tabindex="-1" href="<?php echo base_url();?>smart/list_notif"><?=mysqli_num_rows($result)+mysqli_num_rows($result2)+mysqli_num_rows($result5)+mysqli_num_rows($result6)+mysqli_num_rows($result7)+mysqli_num_rows($result9)+mysqli_num_rows($result10);?></a></span></p>
				<?php  } ?>
				
                   <?php if ($jobs!=6){ ?>
                   <p>Notification <a tabindex="-1" href="<?php echo base_url();?>smart/list_notif"><span class="badge badge-inverse"><?=mysqli_num_rows($result2)+mysqli_num_rows($result3)+mysqli_num_rows($result5)+mysqli_num_rows($result6)+mysqli_num_rows($result7)+mysqli_num_rows($result8)+mysqli_num_rows($result9)+mysqli_num_rows($result10);?></a></span></p>
                   <?php } ?>
				</div>
						<ul>
							<?php	
							//Notification untuk LAB saja
							if ($jobs==6){ 
							?>
							<?php while ($row = mysqli_fetch_assoc($result)) { ?>
							<div>
							<li>
							<?php if ($userlevel=="master" || $userlevel=="supervisor"  ){ ?>
							<a href="<?php echo base_url();?>lab/lab_job/2"> <?php } ?><span>Lab Request Approval : <?=$row['pat_name'];?>,  <?=time_elapsed_string($row['order_date']);?></a></span>
							</li>
							</div>
							<?php if(mysqli_num_rows($result) == 1)
							{
							?>
							<div>
							<li>
							<?php if ($userlevel=="master" || $userlevel=="supervisor"  ){ ?>
							<a href="<?php echo base_url();?>lab/lab_job/2"> <?php } ?><span>Lab Request Approval : <?=$row['pat_name'];?>,  <?=time_elapsed_string($row['order_date']);?></a></span>
							</li>
							</div>
							<?php 
									} 
								}
							}
							?>
					       
							<!-- KHUSUS PR -->
							<?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
							<div>
							<li>
							<?php if ($userlevel=="master" || $userlevel=="supervisor"  ){ ?>
							<a href="<?php echo base_url();?>inv/listpr_app"> <?php } ?><span>Purchase Request Approval : <?=$row2['pr_no'];?>,  <?=time_elapsed_string($row2['create_date']);?></a></span>
							</li>
							</div>
							<?php if(mysqli_num_rows($result2) == 1)
							{
							?>
							<div>
							<li>
							<?php if ($userlevel=="master" || $userlevel=="supervisor"  ){ ?>
							<a href="<?php echo base_url();?>inv/listpr_app"> <?php } ?><span>Purchase Request Approval : <?=$row2['pr_no'];?>,  <?=time_elapsed_string($row2['create_date']);?></a></span>
							</li>
							</div>
							<?php 
								} 
							}
							?>
						   
							<!-- KHUSUS PO -->
							<?php while ($row3 = mysqli_fetch_assoc($result3)) { ?>
							<div>
							<li>
							<?php if ($userlevel=="master" || $userlevel=="supervisor"  ){ ?>
							<a href="<?php echo base_url();?>inv/listpo_app"> <?php } ?><span>Purchase Order Approval : <?=$row3['po_no'];?>,  <?=time_elapsed_string($row3['created_date']);?></a></span>
							</li>
							</div>
							<?php if(mysqli_num_rows($result3) == 1)
							{
							?>
							<div>
							<li>
							<?php if ($userlevel=="master" || $userlevel=="supervisor"  ){ ?>
							<a href="<?php echo base_url();?>inv/listpo_app"> <?php } ?><span>Purchase Order Approval : <?=$row3['po_no'];?>,  <?=time_elapsed_string($row3['created_date']);?></a></span>
							</li>
							</div>
							<?php 
								} 
							}
							?>

                            <!-- KHUSUS Transfer Item -->
                            <?php while ($row5 = mysqli_fetch_assoc($result5)) { ?>
                            <div>
                            <li>
                            <a href="<?php echo base_url();?>inv/listmi_app"> <span>Transfer Item Request Approval : <?=$row5['mi_no'];?>,  <?=time_elapsed_string($row5['create_date']);?></a></span>
                            </li>
                            </div>
                            <?php if(mysqli_num_rows($result5) == 1)
                            {
                            ?>
                            <div>
                            <li>
                            <a href="<?php echo base_url();?>inv/listmi_app"> <span>Transfer Item Request Approval : <?=$row5['mi_no'];?>,  <?=time_elapsed_string($row5['create_date']);?></a></span>
                            </li>
                            </div>
                            <?php 
                                } 
                            }
                            ?>
							
							<!-- SMART NOTIFICATION -->
                            <?php $aa=1; while ($row6 = mysqli_fetch_assoc($result6)) { ?>
                            <div>
                            <li>
                            <a href="<?php echo base_url();?>smart/list_notif"> <span><?=$aa++;?>. Price Not Available for <?=$row6['price_type'];?> : <?=$row6['serv_name'];?> [<?=$row6['notes'];?>],  <?=time_elapsed_string($row6['create_date']);?></a></span>
                            </li>
                            </div>
                            <?php if(mysqli_num_rows($result6) == 1)
                            {
                            ?>
                            <div>
                            <li>
                            <a href="<?php echo base_url();?>smart/list_notif"> <span><?=$aa++;?>. Price Not Available for <?=$row6['price_type'];?> : <?=$row6['serv_name'];?> [<?=$row6['notes'];?>],  <?=time_elapsed_string($row6['create_date']);?></a></span>
                            </li>
                            </div>
                            <?php 
                                } 
                            }
                            ?>
														
							<!-- QUOTATION NOTIFICATION -->
                            <?php while ($row7 = mysqli_fetch_assoc($result7)) { ?>
                            <div>
                            <li>
							<?php if ($userlevel=="master" || $userlevel=="supervisor"  ){ ?>
                            <a href="<?php echo base_url();?>marketing/list_quotation_app"><?php } ?> <span>Request Approval Quotation : <?=$row7['qout_id'];?><?php if($row7['quot_revision']>1){ echo "/Rev-".$row7['quot_revision'];} ?> - By <b><?=$row7['fullname'];?></b>,  <?=time_elapsed_string($row7['quot_date_create']);?></a></span>
                            </li>
                            </div>
                            <?php if(mysqli_num_rows($result7) == 1)
                            {
                            ?>
                            <div>
                            <li>
							<?php if ($userlevel=="master" || $userlevel=="supervisor"  ){ ?>
                            <a href="<?php echo base_url();?>marketing/list_quotation_app"><?php } ?> <span>Request Approval Quotation : <?=$row7['qout_id'];?><?php if($row7['quot_revision']>1){ echo "/Rev-".$row7['quot_revision'];} ?> - By <b><?=$row7['fullname'];?></b>,  <?=time_elapsed_string($row7['quot_date_create']);?></a></span>
                            </li>
                            </div>
                            <?php 
                                } 
                            }
                            ?>

                            <!-- KHUSUS Request Item -->
                            <?php 
                            while ($row8 = mysqli_fetch_assoc($result8)) { 
                            ?>
                            <div>
                            <li>
                            <a href="<?php echo base_url();?>inv/list_request_items"> <span>List Request Item From : <?=$row8['source'];?>,  <?=time_elapsed_string($row8['create_date']);?></a></span>
                            </li>
                            </div>
                            <?php if(mysqli_num_rows($result8) == 1)
                            {
                            ?>
                            <div>
                            <li>
                             <a href="<?php echo base_url();?>inv/list_request_items"> <span>List Request Item From : <?=$row8['source'];?>,  <?=time_elapsed_string($row8['create_date']);?></a></span>
                            </li>
                            </div>
                            <?php 
                                } 
                            }
                            ?>
							
                            <!-- KHUSUS Request Item -->
                            <?php 
                            while ($row9 = mysqli_fetch_assoc($result9)) { 
                            ?>
                            <div>
                            <li>
                            <a href="<?php echo base_url();?>smart/list_notif"> <span>List Request Approval Transfer Items : <?=$row9['mi_no'];?>,  <?=time_elapsed_string($row9['create_date']);?></a></span>
                            </li>
                            </div>
                            <?php if(mysqli_num_rows($result9) == 1)
                            {
                            ?>
                            <div>
                            <li>
                             <a href="<?php echo base_url();?>smart/list_notif"> <span>List Request Approval Transfer Items : <?=$row9['mi_no'];?>,  <?=time_elapsed_string($row9['create_date']);?></a></span>
                            </li>
                            </div>
                            <?php 
                                } 
                            }
                            ?>


                            <!-- KHUSUS Request Item2 -->
                            <?php 
                            if ($userlevel=="master" || $userlevel=="supervisor"  ){
                            while ($row10 = mysqli_fetch_assoc($result10)) { 
                            ?>
                            <div>
                            <li>
                            <a href="<?php echo base_url();?>smart/list_notif"> <span>List Item Request : <?=$row10['item_name'];?>,  <?=time_elapsed_string($row10['create_date']);?></a></span>
                            </li>
                            </div>
                            <?php if(mysqli_num_rows($result10) == 1){ ?>
                            <div>
                            <li>
                             <a href="<?php echo base_url();?>smart/list_notif"> <span>List Item Request : <?=$row10['item_name'];?>,  <?=time_elapsed_string($row10['create_date']);?></a></span>
                            </li>
                            </div>
                            <?php 
                                } 
                            } // Tutup While
                            } // Tutup If
                            ?>

						</ul>
			</div>
			<?php
			}
			?>
        </div>
		<?php } ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <!--SPAN-->
				<!--PENGATURAN CONTENT MENU DIBAWAH INI-->
				<?=$contents?>
			</div>    
        </div>

            <!-- <footer>
                <p align="center"><span class="badge badge-inverse"><b>Kyoai Online - <?=round($deltat,5)?> sec.</?=?></b></br></span></p>
            </footer>
             -->
        <?php
		mysqli_close($con);
		?>
    </body>
</html>
<script>
	  function mst_curr(){
		window.open("<?php echo base_url();?>marketing/mst_currency","Popup","height=250, width=550, top=110, left=450");
	  }
	  function open_chat(){
		window.open("<?php echo base_url();?>home/chat","Popup","height=450, width=550, top=110, left=450");
	  }
</script>