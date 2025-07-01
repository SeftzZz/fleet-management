<html>
<head>
    <title>Cetak Nota </title>
    <style>
        @page { margin: 0 }
        body { margin: 0; font-size:13px;font-family: monospace;}
        td { font-size:12px; }
        .sheet {
            margin: 0;
            overflow: hidden;
            position: relative;
            box-sizing: border-box;
            page-break-after: always;
        }

        /** Paper sizes **/
        body.struk        .sheet { width: 80mm; }
        body.struk .sheet        { padding: 2mm; }

        .txt-left { text-align: left;}
        .txt-center { text-align: center;}
        .txt-right { text-align: right;}
        .last-text { width: 70px }

        /** For screen preview **/
        @media screen {
            body { background: #e0e0e0;font-family: monospace; }
            .sheet {
                background: white;
                box-shadow: 0 .5mm 2mm rgba(0,0,0,.3);
                margin: 5mm;
            }
        }

        /** Fix for Chrome issue #273306 **/
        @media print {
            body { font-family: monospace; }
            body.struk                 { width: 58mm; text-align: left;}
            body.struk .sheet          { padding: 2mm; }
            .txt-left { text-align: left;}
            .txt-center { text-align: center;}
            .txt-right { text-align: right;}
        }
    </style>
</head>
<body class="struk" onload="printOut()">
<?php
    $dataFNBAdditional = array();
    $this->db->from('fnb_additional_cooking');
    $this->db->join('user', 'user.idUser=fnb_additional_cooking.idUser');
    $this->db->join('fnb_additional_booking', 'fnb_additional_booking.invoiceFnbadditional=fnb_additional_cooking.invoiceFnbadditional');
    $this->db->join('Business_Detail', 'Business_Detail.idBusiness=fnb_additional_cooking.idBusiness');
    $this->db->where('fnb_additional_cooking.invoiceFnbadditional', $fnbdetail->invoiceFnbadditional);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        $dataFNBAdditional = $query->row();
    }
    $query->free_result();
?>
<section class="sheet" style="padding-left: 4mm;padding-right: 4mm;">
    <table cellpadding="0" cellspacing="0" style="text-align: center; width: 100%; margin-top: 5mm;">
        <tr>
            <td style="font-size: 15px"><?php echo $dataFNBAdditional->restaurantBusiness ?></td>
        </tr>
        <tr>
            <td style="font-size: 14px"><?php echo $dataFNBAdditional->addres ?></td>
        </tr>
        <tr>
            <td style="font-size: 14px">TELP <?php echo $dataFNBAdditional->longitude ?></td>
        </tr>
    </table>
    ======================================
    <table cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <td align="left" class="txt-left">Tanggal&nbsp;</td>
            <td align="left" class="txt-left">:</td>
            <td align="left" class="txt-left">&nbsp;<?php echo (new DateTime($dataFNBAdditional->createdAtFnbcooking))->format('Y-m-d'); ?></td>
        </tr>
        <tr>
            <td align="left" class="txt-left">Jam&nbsp;</td>
            <td align="left" class="txt-left">:</td>
            <td align="left" class="txt-left">&nbsp;<?php echo (new DateTime($dataFNBAdditional->createdAtFnbcooking))->format('H:i:s'); ?></td>
        </tr>
        <tr>
            <td align="left" class="txt-left">Kamar Tamu&nbsp;</td>
            <td align="left" class="txt-left">:</td>
            <td align="left" class="txt-left">&nbsp;<?php echo $dataFNBAdditional->numberroomFnbadditional ?></td>
        </tr>
        <!-- <tr>
            <td align="left" class="txt-left">Membership&nbsp;</td>
            <td align="left" class="txt-left">:</td>
            <td align="left" class="txt-left">&nbsp;Silver</td>
        </tr> -->
    </table>
    ======================================
    <table cellpadding="0" cellspacing="0" style="width:100%">
        <?php
            $totalFormatted = $taxFormatted = $grandTotalFormated = "0";
            $subtotalPrice = 0;
            $data = array();
            $this->db->from('fnb_additional_booking');
            $this->db->where('invoiceFnbadditional', $fnbdetail->invoiceFnbadditional);
            $this->db->where('fnb_additional_booking.orderFnbadditional !=', 'SOLD_OUT');
            $query = $this->db->get();
            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    $data[] = $row;
                }
            }
            $query->free_result();
            foreach($data as $row) {
        ?>
        <tr>
            <td align="left" class="txt-left" colspan="2"><?php echo $row->ketFnbadditional ?></td>
        </tr>
        <?php 
        if ($row->packageFnbadditional != null) {
            // Decode JSON ke array asosiatif
            $packages = json_decode($row->packageFnbadditional, true);

            if ($packages) {
                foreach ($packages as $key => $value) {
                    ?>
                    <tr style="padding-top: 5px;padding-bottom: 5px;">
                        <td align="left" class="txt-left"><?php echo htmlspecialchars($key); ?></td>
                        <td align="left" class="txt-left">: <?php echo htmlspecialchars($value); ?></td>
                    </tr>
                    <?php
                }
            } else {
                // Jika JSON tidak valid, tampilkan pesan error
                ?>
                <tr>
                    <td colspan="2" align="left" class="txt-left">Invalid package data</td>
                </tr>
                <?php
            }
        }
        ?>
        <tr>
            <td align="left" class="txt-left" style="font-size: 10px;">Note: <?php echo $row->descFnbadditional ?></td>
        </tr>
        <tr>
            <td class="txt-left" align="left">
                <?php
                $qty = number_format($row->qtyFnbadditional, 0, '.', '.');
                $price = number_format($row->priceFnbadditional, 0, '.', '.');
                $total = number_format($dataFNBAdditional->subtotalPrice, 0, '.', '.');
                $tax = $dataFNBAdditional->subtotalPrice * 0.21;

                // Format and align with fixed widths
                $qtyFormatted = sprintf('%-13s', $qty);
                $priceFormatted = sprintf('%9s', $price);
                $totalFormatted = sprintf('%10s', $total);
                $taxFormatted = number_format($dataFNBAdditional->subtotalPrice * 0.21, 0, '.', '.');
                $grandTotal = $dataFNBAdditional->subtotalPrice;
                $grandTotalFormated = number_format($grandTotal, 0, '.', '.');
                echo $qty . ' x @' . $price
                ?>
                <!-- <p style="float: right;margin-block-start: 0;margin-block-end: 0;">
                    <?php echo $total ?>
                </p> -->
            </td>
        </tr>
        <?php } ?>
    </table>
    --------------------------------------
    <table cellpadding="0" cellspacing="0" style="width:100%; ">
        <tr>
            <td style="display: flex;float: right;font-size: 12px;">
                <div align="left" class="txt-right">Sub Total&nbsp;</div>
                <div align="left" class="txt-right">:</div>
                <div class="txt-right last-text" align="left">&nbsp;<?php echo $totalFormatted ?></div>
            </td>
        </tr>
        <!-- <tr>
            <td style="display: flex;float: right;font-size: 12px;">
                <div align="left" class="txt-right">Discount (10%) &nbsp;</div>
                <div align="left" class="txt-right">:</div>
                <div class="txt-right last-text" align="left">&nbsp;2.000</div>
            </td>
        </tr> -->
        <!-- <tr>
            <td style="display: flex;float: right;font-size: 12px;">
                <div align="left" class="txt-right">Pajak (21%) &nbsp;</div>
                <div align="left" class="txt-right">:</div>
                <div class="txt-right last-text" align="left">&nbsp;<?php echo $taxFormatted ?></div>
            </td>
        </tr> -->
        <tr>
            <td style="float: right;font-size: 12px;">
             ---------------
            </td>
        </tr>
        <tr>
            <td style="display: flex;float: right;font-size: 12px;">
                <div align="left" class="txt-right">Bill&nbsp;</div>
                <div align="left" class="txt-right">:</div>
                <div class="txt-right last-text" align="left">&nbsp;<?php echo $grandTotalFormated ?></div>
            </td>
        </tr>
    </table>

    <table cellpadding="0" cellspacing="0" style="text-align: center; width: 100%; margin-top: 5mm;">
        <tr>
            <td style="font-size: 15px">Thank you</td>
        </tr>
    </table>
</section>

</body>
<script>
    var lama = 1000;
    t = null;
    function printOut() {
        window.print();
        t = setTimeout("self.close()", lama);
    }
</script>
</html>