<section class="no-padding-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="block">
          <div class="d-flex">
            <h2 class="mr-auto pt-2 pl-2 font-weight-light"><?php echo $purchase_order->user_note ?> (<span style="color:<?php echo $purchase_order->color ?>"><?php echo strtolower($purchase_order->status_name) ?></span>)</h2>
            <a class="align-self-end pr-2 pb-2 pt-2" href="purchaseorder/create_purchase_order_item_view/<?php echo $purchase_order_id ?>"><button class="btn btn-primary btn-sm">Add Item</button></a>
          </div>
          <div class="table-responsive pt-3">
            <table class="table" style="width:100%"> 
              <thead> 
                <tr> 
                  <th colspan="3">Description</th>
                  <th>Qty.</th>
                  <th>Unit Price</th>
                  <th>Total</th>
                  <th></th>
                </tr> 
              </thead> 
              <tbody id="list_of_purchase_order_items" data-id="<?php echo $purchase_order_id ?>"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>