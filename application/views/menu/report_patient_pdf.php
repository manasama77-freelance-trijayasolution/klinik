<h1 align="center">Report Patient</h1>
<h3 align="center">Periode <?php echo $datereg1 . " s/d " . $datereg2; ?></h3>

<table border="1" width="100%" align="center" style="font-size: 11px;">
    <tr style="background-color:#A29D9B">
        <th style="text-align: center;">No.</th>
        <th style="text-align: center;">ID REGISTRATION</th>
        <th style="text-align: center;">ORDER DATE</th>
        <th style="text-align: center;">PATIENT NAME</th>
        <th style="text-align: center;">ODONTOGRAM</th>
        <th style="text-align: center;">SERVICE</th>
        <th style="text-align: center;">DOCTOR NAME</th>
        <th style="text-align: center; min-width: 100px; width: 100px;">PAYMENT METHOD</th>
        <th style="text-align: center; min-width: 100px; width: 100px;">PRICE</th>
    </tr>
    <?php
    $price = 0;
    $total = 0;
    foreach ($result as $key) {
    ?>
        <tr class="odd gradeX">
            <td style="vertical-align: top;"><?= $key['no']; ?></td>
            <td style="vertical-align: top;"><?= $key['id_reg']; ?></td>
            <td style="vertical-align: top;"><?= date("d.m.Y", strtotime($key['reg_date'])); ?></td>
            <td style="vertical-align: top;"><?= $key['pat_name']; ?> </td>
            <td style="vertical-align: top;"><?= $key['odo']; ?></td>
            <td style="vertical-align: top;"><?= $key['serv']; ?></td>
            <td style="vertical-align: top;"><?= $key['doctor_name']; ?></td>
            <td style="vertical-align: top;"><?= $key['type_payment']; ?><br><?= $key['card_no']; ?></td>
            <td style="vertical-align: top; text-align: right;"><?php echo number_format($key['sub_total'], 0); ?></td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td align="right" colspan="8"><b>TOTAL</b></td>
        <td align="right"><b><?= number_format($grand_total, 0); ?></b></td>
    </tr>
</table>