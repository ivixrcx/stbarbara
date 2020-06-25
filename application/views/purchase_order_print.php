<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purchase Order</title>
<style>

* {
  font-size: 13px;
}

table {
  border-collapse: collapse;
  width: 100%;
}

tr th {
  text-align: center;
}

tr.borderless td {
  border: none !important;
}

td, th {
  border: 1px solid #aaa;
  text-align: left;
  padding: 8px;
}

tr.title {
  background: #eee;
}

tr.break td {
  border: 0;
}

tr.grand-total td {
  border-top: 3px double #666;
}

.text-left {
  text-align: left;
}

.text-center {
  text-align: center;
}

.text-right {
  text-align: right;
}

</style>
</head>
<body>

<img src="<?php echo FCPATH . 'assets/images/letterhead.png' ?>" style="width: 40%">
<table style="margin-top:15px">
  <tr>
    <td colspan="4"><b>VENDOR:</b>&nbsp;&nbsp;<?php echo strtoupper($purchase_order->supplier_name) ?></td>
    <td><b>DATE:</b>&nbsp;&nbsp;<?php echo date('M d, Y', strtotime($purchase_order->approved_date))?></td>

  </tr>
  <tr>
    <td colspan="4"><b>CONTACT:</b>&nbsp;&nbsp;<?php echo $purchase_order->contact_no ?></td>
    <td><b>PO#:</b>&nbsp;&nbsp;<?php echo $purchase_order->purchase_order_no ?></td>
  </tr>
  <tr>
    <td colspan="5"><b>ADDRESS:</b>&nbsp;&nbsp;<?php echo strtoupper($purchase_order->address) ?></td>
  </tr>
  <tr>
    <td colspan="5"><b>DELIVERY TO:</b>&nbsp;&nbsp;<?php echo strtoupper($purchase_order->warehouse_name . ' (' . $purchase_order->warehouse_location . ')' ) ?></td>
  </tr>
  <tr class="break"><td colspan="5"></td></tr>
  <!-- <tr class="break"><td colspan="5"></td></tr> -->
  <tr class="title">
    <th>QTY.</th>
    <th colspan="2">ITEM DESCRIPTION </th>
    <th>UNIT PRICE</th>
    <th>TOTAL</th>
  </tr>
  <?php 
  $total = 0;
  foreach($items as $item){ 
  $total += $item->total; 
  ?>
  <tr>
    <td class="text-center"><?php echo $item->quantity ?></td>
    <td colspan="2"><?php echo $item->description ?></td>
    <td class="text-center"><?php echo $item->unit_price ?></td>
    <td class="text-right"><?php echo number_format($item->total, 2, '.',',') ?></td>
  </tr>
  <?php } ?>
  <tr class="grand-total">
    <td colspan="3">&nbsp;</td>
    <td class="text-center"><b>TOTAL</b></td>
    <td class="text-right"><b><?php echo number_format($total, 2, '.',',') ?></b></td>
  </tr>
  <tr class="break"><td colspan="5"></td></tr>
  <tr class="break"><td colspan="5"></td></tr>
  <tr class="borderless">
    <td colspan="3"><b>Requested:</b>&nbsp;<?php echo ucwords($purchase_order->req_full_name) ?></td>
    <!-- <td class="text-left"><b>Date:</b> <?php echo date('M. d, Y', strtotime($purchase_order->requested_date)) ?></td> -->
    <td colspan="3"><b>Approved:</b>&nbsp;&nbsp; <?php echo ucwords($purchase_order->appr_full_name) ?></td>

  </tr>
  <!-- <tr class="break"><td colspan="5"></td></tr>
  <tr class="borderless">
    <td colspan="4"><b>Prepared by:</b>&nbsp;&nbsp;<?php echo ucwords($purchase_order->prep_full_name) ?></td>
    <td class="text-left"><b>Date:</b> <?php echo date('M. d, Y', strtotime($purchase_order->prepared_date)) ?></td>
  </tr> -->
  <!-- <tr class="break"><td colspan="5"></td></tr>
  <tr class="borderless">
    <td class="text-left"><b>Date:</b> <?php echo date('M. d, Y', strtotime($purchase_order->approved_date)) ?></td>
  </tr> -->
</table>

</body>
</html>
