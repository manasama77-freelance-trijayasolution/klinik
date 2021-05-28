<h1 align="center">Report Profit</h1>
<h3 align="center">Periode <?php echo $datereg1 . " s/d " . $datereg2; ?></h3>

<table border='1' width="100%" align="center">
    <tr style="background-color:#A29D9B">
        <th style="width:30px">No.</th>
        <th>Date</th>
        <th>Item In</th>
        <th>Item Out</th>
        <th>Total</th>
        <th>Payment</th>
        <th>Info</th>
    </tr>
    <?php
    $i         = 1;
    $total     = 0;
    foreach ($data->result() as $row) {
        $total = $total + $row->Price;
    ?>
        <tr class="odd gradeX">
            <td><?php echo $i++; ?></td>
            <td><?php echo date("d.m.Y", strtotime($row->tgl)); ?></td>
            <td><?php echo $row->item_out; ?> </td>
            <td><?php echo $row->item_in; ?> </td>
            <td align="right"><?php echo number_format($row->Price, 2); ?></td>
            <td><?= $row->type_payment; ?> </td>
            <td><?php echo $row->ket; ?> </td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td align="center" colspan="4"><b>TOTAL</b></td>
        <td align="right"><b><?= number_format($total, 2); ?></b></td>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>