<h1 align="center">Report Profit</h1>
<h3 align="center">Periode <?php echo $datereg1 . " s/d " . $datereg2; ?></h3>

<table border="1" width="100%" align="center" style="font-size: 18px; padding: 5px;">
    <thead>
        <tr style="background-color:#A29D9B; padding: 5px;">
            <th style="width:30px; padding: 3px;">No.</th>
            <th style="padding: 3px;">Date</th>
            <th style="padding: 3px;">Buy Item</th>
            <th style="padding: 3px;">Sell Item</th>
            <th style="padding: 3px;">Cash Out</th>
            <th style="padding: 3px;">Cash In</th>
            <th style="padding: 3px;">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i         = 1;
        $total     = $arr_data['total'];
        foreach ($arr_data['result'] as $key) {
        ?>
            <tr class="odd gradeX" style="padding: 3px;">
                <td style="padding: 3px; text-align: center;"><?= $i++; ?></td>
                <td style="padding: 3px; text-align: center;"><?= $key['date']; ?></td>
                <td style="padding: 3px;"><small><?= $key['in']; ?></small></td>
                <td style="padding: 3px;"><small><?= $key['out']; ?></small></td>
                <td align="right" style="padding: 3px;"><?= number_format((int)$key['price_in'], 0); ?></td>
                <td align="right" style="padding: 3px;"><?= number_format((int)$key['price_out'], 0); ?></td>
                <td align="right" style="padding: 3px;"><?= number_format((int)$key['total'], 0); ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td align="right" colspan="6" style="padding: 3px;"><b>TOTAL</b></td>
            <td align="right" style="padding: 3px;"><b><?= number_format($total, 0); ?></b></td>
        </tr>
    </tfoot>
</table>