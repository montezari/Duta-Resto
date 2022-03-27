<div class="panel panel-default">
  <div class="progress progress-striped active" style="display:none;" id="wait">
    <div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
      <span class="sr-only">100% Complete</span>
    </div>
  </div>
  <input name='finishorder-fkey' id='onprogress-fkey' type='hidden' size=/>
  <div class="panel-body">
    <div class="pull-left">
        <div class="text-left">
            <p id="finishorder-info-pesanan">
            </p>
            <h4>Total : [blksql.#] Items</h4>
        </div>
    </div>
    <div class="clearfix"></div>
    <hr>
    <!-- TABLE -->
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
          <th width="3%">
            <div class='text-center'>Qty Finish</div>
          </th>
          <th width="3%">
            <div class='text-center'>Qty Served</div>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class='only-checkbox'>
            <input type='checkbox' checked>
          </td>
          <td>[blksql.vNamaBarang;noerr;block=tr]</td>
          <td>
            <div class='text-left'>[blksql.cKeterangan;noerr;block=tr]</div>
          </td>
          <td>
            <div class='text-right'>[blksql.vQtyKitchen;noerr;block=tr]</div>
          </td>
          <td>
            <div class='text-right'>[blksql.vQtyServed;noerr;block=tr]</div>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- /TABLE -->
  </div>
  <!-- /PANEL BODY --> 
</div>
