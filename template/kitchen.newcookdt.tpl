<script src="js.php?src=kitchen.post" type="text/javascript"></script>
<div class="panel panel-default">
  <div id="multi-msg"></div>
  <div class="panel-body">
    <div class="pull-left">
        <div class="text-left">
            <p id="onprogress-info-pesanan">
            </p>
            <h4>Total : [blksql.#] Items</h4>
        </div>
    </div>
    <div class="pull-right hidden-xs">
        <div class="btn-group">
            <button class="btn btn-default" id="multi-post" onclick="dosubmit();"><i class="fa fa-check"></i> Update Order</button>
        </div>
    </div>
    <div class="clearfix"></div>
    <hr>
    <!-- TABLE -->
    <form name="multiform" id="multiform" action="ajax/kitchen.update.php" method="POST" enctype="multipart/form-data">
    <input name='onprogress-fkey' id='onprogress-fkey' type='hidden' size=/>
    <table class='table table-hover'>
      <thead>
        <tr>
          <th class='only-checkbox' width="1%">
            #
          </th>
          <th width="40%">Item</th>
          <th>
            <div class='text-left'>Description</div>
          </th>
          <th width="2%">
            <div class='text-center'>Qty Request</div>
          </th>
          <th width="2%">
            <div class='text-center'>Qty Finish</div>
          </th>
          <th width="2%">
            <div class='text-center'>Qty Kitchen</div>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class='only-checkbox'>
            <input type='checkbox' checked>
            <input name='idpesandt[]' id='idpesandt[]' type='hidden' value="[blksql.cKdPesananDt;noerr;block=tr]" size=/>
          </td>
          <td>[blksql.vNamaBarang;noerr;block=tr]</td>
          <td>
            <div class='text-left'>[blksql.cKeterangan;noerr;block=tr]</div>
          </td>
          <td>
            <div class='text-right'><input class="form-control input-sm" type="text" id="qtyreq[]" name="qtyreq[]" = value="[blksql.vQty;noerr;block=tr]" readonly></div>
          </td>
          <td>
            <div class='text-right'><input class="form-control input-sm" type="text" id="qtyfinish[]" name="qtyfinish[]" value="[blksql.vQtyKitchen;noerr;block=tr]" readonly></div>
          </td>
          <td>
            <div class='text-right'><input class="form-control input-sm" type="text" id="qtykitchen[]" name="qtykitchen[]" value="[blksql.vQtySaldo;noerr;block=tr]"></div>
          </td>
        </tr>
      </tbody>
    </table>
    </form>
    <!-- /TABLE -->
  </div>
  <!-- /PANEL BODY --> 
</div>
