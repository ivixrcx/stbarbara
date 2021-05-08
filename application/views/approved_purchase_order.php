<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="block">
            <h4 class="mr-auto pt-2"><?php echo ucwords($purchase_order->user_note) . '<br/><small>#' . $purchase_order->purchase_order_no . '</small>' ?></h4>

            <table cellpadding="10">
                <tr>
                    <td class="pr-3">Requested:</td>
                    <td><span class="font-weight-bold"><?php echo ucwords($purchase_order->req_full_name) ?></span> <?php echo date('m/d/Y', strtotime($purchase_order->requested_date)) ?></td>
                </tr>
                <tr>
                    <td>Prepared:</td>
                    <td><span class="font-weight-bold"><?php echo ucwords($purchase_order->prep_full_name) ?></span> <?php echo date('m/d/Y', strtotime($purchase_order->prepared_date)) ?></td>
                </tr>
            </table>
            <h4 class="mr-auto pt-5">Items</h4>
            <div class="table-responsive pt-2">
                <table class="table" style="width: 100%">
                    <thead> 
                        <tr> 
                        <th colspan="3">Description</th>
                        <th>Qty.</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        </tr> 
                    </thead> 
                    <tbody id="list_of_purchase_order_items" data-id="<?php echo $purchase_order->purchase_order_id ?>"></tbody>
                </table>
            </div>
            <a href="print/purchase-order/<?php echo $purchase_order->purchase_order_id ?>" target="_blank" class="btn btn-primary mt-5 btn-block btn-lg font-weight-bold"><i class="fa fa-print">&nbsp;</i>Print</a>
            <button type="button" class="pull-right btn btn-danger mt-5 btn-block btn-lg font-weight-bold text-dark btndelete" data-purchase_order_id="<?php echo $purchase_order->purchase_order_id; ?>"><i class="fa fa-remove text-dark">&nbsp;</i>DELETE</button>
        </div>
      </div>
    </div>
  </div>
</section>