<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DEVELOPMENT | PRINT LABEL PATIENT</title>
    <style>
    body {
        width: 14.88in;
        margin: 0.0in 0.0in;
        }
    .label{
        /* Avery 5160 labels -- CSS and HTML by MM at Boulder Information Services */
        width: 3.33in; /* plus .6 inches from padding */
        height: 1.1in; /* plus .125 inches from padding */
        padding: .0in 0.065in 0;
        margin-right: .125in; /* the gutter */

        float: left;

        text-align: left;
		font-size: 0.80em;
		font-family: Tahoma, Geneva, sans-serif;
        overflow: hidden;
        outline: 1px dotted; /* outline doesn't occupy space like border does */
        }
    .page-break  {
        clear: left;
        display:block;
        page-break-after:always;
        }
    </style>

</head>
<body>

<?php for ($i=0; $i < 8 ; $i++) { ?>
<div class="label"><div style="float:left; width:50%"><?php echo $pat_name;?></div><div style="float:right; width:50%;"><img src="https://chart.googleapis.com/chart?chs=79x79&cht=qr&chl=110114523&choe=UTF-8" title="Kyoai Medical Services" /></div></br><?php echo $age;?> / <?php echo $gender;?></br><?php echo date("d.m.Y",strtotime($pat_dob));?></br><?php echo $pat_mcu;?></div>
<?php } ?>

<!-- 
<div class="label"><div style="float:left; width:50%">Mr. Bean Tungdesem W.</div><div style="float:right; width:50%;"><img src="https://chart.googleapis.com/chart?chs=79x79&cht=qr&chl=110114523&choe=UTF-8" title="Kyoai Medical Services" /></div></br>39 / M</br>21.12.2012</br>MCU Batu Nisan 2016 B</div>
<div class="label"><div style="float:left; width:50%">Mr. Bean Tungdesem W.</div><div style="float:right; width:50%;"><img src="https://chart.googleapis.com/chart?chs=79x79&cht=qr&chl=110114523&choe=UTF-8" title="Kyoai Medical Services" /></div></br>39 / M</br>21.12.2012</br>MCU Batu Nisan 2016 B</div>
<div class="label"><div style="float:left; width:50%">Mr. Bean Tungdesem W.</div><div style="float:right; width:50%;"><img src="https://chart.googleapis.com/chart?chs=79x79&cht=qr&chl=110114523&choe=UTF-8" title="Kyoai Medical Services" /></div></br>39 / M</br>21.12.2012</br>MCU Batu Nisan 2016 B</div> 
-->

<!-- 
<div class="label"><div style="float:left; width:50%">Mr. Bean Tungdesem W.</div><div style="float:right; width:50%;"><img src="https://chart.googleapis.com/chart?chs=79x79&cht=qr&chl=110114523&choe=UTF-8" title="Kyoai Medical Services" /></div></br>39 / M</br>21.12.2012</br>MCU Batu Nisan 2016 B</div>
<div class="label"><div style="float:left; width:50%">Mr. Bean Tungdesem W.</div><div style="float:right; width:50%;"><img src="https://chart.googleapis.com/chart?chs=79x79&cht=qr&chl=110114523&choe=UTF-8" title="Kyoai Medical Services" /></div></br>39 / M</br>21.12.2012</br>MCU Batu Nisan 2016 B</div>
<div class="label"><div style="float:left; width:50%">Mr. Bean Tungdesem W.</div><div style="float:right; width:50%;"><img src="https://chart.googleapis.com/chart?chs=79x79&cht=qr&chl=110114523&choe=UTF-8" title="Kyoai Medical Services" /></div></br>39 / M</br>21.12.2012</br>MCU Batu Nisan 2016 B</div>
<div class="label"><div style="float:left; width:50%">Mr. Bean Tungdesem W.</div><div style="float:right; width:50%;"><img src="https://chart.googleapis.com/chart?chs=79x79&cht=qr&chl=110114523&choe=UTF-8" title="Kyoai Medical Services" /></div></br>39 / M</br>21.12.2012</br>MCU Batu Nisan 2016 B</div>
<div class="page-break"></div>
 -->
</body>
</html>