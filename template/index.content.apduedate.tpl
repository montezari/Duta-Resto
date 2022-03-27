<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-body">
            <h3 class="form-title">Accounts Payable</h3>
            <table class="table table-striped table-bordered table-hover">
             <thead>
                <tr>
                   <th>Supplier</th>
                   <th>PO</th>
                   <th>Amount</th>
                   <th>Total Pay</th>
                   <th>Due Date</th>
                </tr>
             </thead>
             <tbody>
                <tr>
                   <td>[blksql.vNmSupplier;noerr;block=tr]</td>
                   <td>[blksql.cNoPO;noerr;block=tr]</td>
                   <td>[blksql.nGrandTotal;frm='0,000.00';noerr;block=tr]</td>
                   <td>[blksql.nTotalPay;frm='0,000.00';noerr;block=tr]</td>
                   <td><span class="[blksql.cClass;noerr;block=tr]">[blksql.dTglJT;frm='dd/mm/yyyy';noerr;block=tr]</span></td>
                </tr>
                <tr>
                   <td colspan="6">[blksql;block=tr;nodata]There is no data. </td>
                </tr>
             </tbody>
        </table>
        </div>
    </div>
</div>