<h1 align="center">Report Expense</h1>
<h3 align="center">Periode <?php echo $datereg1 . " s/d " . $datereg2; ?></h3>

<table border='1' width="100%" align="center">
    <tr style="background-color:#A29D9B">
        <th style="width:30px">No.</th>
        <th>Date Expense</th>
        <th>Item Name</th>
        <th>Qty</th>
        <th>Supplier Name</th>
        <th>Amount</th>
    </tr>
    <?php
    $i         = 1;
    $total     = 0;
    foreach ($data->result() as $row) {
        $total = $total + $row->item_amount;
    ?>
        <tr class="odd gradeX">
            <td><?php echo $i++; ?></td>
            <td><?php echo date("d.m.Y", strtotime($row->created_date)); ?></td>
            <td><?php echo $row->item_id; ?> </td>
            <td><?php echo $row->item_qty; ?></td>
            <td><?php echo $row->supplier_id; ?></td>
            <td align="right"><?php echo number_format($row->item_amount, 2); ?></td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td align="center" colspan="5"><b>TOTAL</b></td>
        <td align="right"><b><?php echo number_format($total, 2); ?></b></td>
    </tr>
</table>