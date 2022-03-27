<div class="row">
    <div class="col-xs-12">
        <div class="box">
        [onload_1; when [var.mode;noerr]==0; block=div]
         <div class="box border primary">
            <div class="box-title">
                <div>[var.LABEL.JUMLAH_DATA;noerr;] : [var.~recordcount;noerr]</div>
                <div>[var.LABEL.HALAMAN;noerr;] : [var.~page_sequence;noerr]</div>
            </div>
             <div class="box-body table-responsive">
                <table id="table_grid" class="table table-bordered table-hover">
                <form action="index.php?m=[var.~moduleid;noerr][var.~page_url;noerr]" method="post" name='grid'>
                <input name='fkey' id='fkey' type='hidden' size=/>
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Due Date</th>
                            <th>Amount</th>
                            <th>Return</th>
                            <th>Remains</th>
                            <th>Total Pay</th>
                            <th>Invoices</th>
                            <th colspan="3">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[grid_blk.vNmSupplier;noerr;block=tr]</td>
                            <td>[grid_blk.dTglJT;frm='dd/mm/yyyy';noerr;block=tr]</td>
                            <td>[grid_blk.nGrandTotal;frm='0,000.00';noerr;block=tr]</td>
                            <td>[grid_blk.nTotalRetur;frm='0,000.00';noerr;block=tr]</td>
                            <td>[grid_blk.nSaldo;frm='0,000.00';noerr;block=tr]</td>
                            <td>[grid_blk.nTotalPay;frm='0,000.00';noerr;block=tr]</td>
                            <td>[grid_blk.jml;noerr;block=tr]</td>
                            <td width="25" align="center">[var.button.D;if [var.button.D;noerr]=='valid';then <a href="#" title="Process Payment" class="back" onClick="window.location = '?m=[var.~moduleid;noerr]&mode=form&key=[grid_blk.cKdSupplier;noerr]'"><span class="fa fa-money"></span></a>;else <span class="fa fa-money"></span>]</td>
                        </tr>
                    </tbody>
                    <input type="hidden" name="FormAction" value="HAPUS">
  					</form>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->    

    <div id="input_form">
    [onload_1; when [var.mode;noerr]==1; block=div]
        <div class="box border primary">
        	<div class="box-title">
            </div>
            <div class="box-body">
                <!-- BEGIN FORM-->
               <form name="form" id="form" method="post" action="?m=[var.~moduleid;noerr][var.~page_url;noerr]">
                <input name='fkey' id='fkey' type='hidden' value='[grid_blk.cKdSupplier;noerr;]' size=/>
                    <div class="form-body">
                      	<div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Supplier</label>
                                    <input type="hidden" name="kdsupp" id="kdsupp" class="form-control" value="[grid_blk.cKdSupplier;noerr;]" readonly>
                                    <input type="text" name="nmsupp" id="nmsupp" class="form-control" value="[grid_blk.vNmSupplier;noerr;]" readonly>
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Amount</label>
                                    <input type="text" name="total" id="total" class="form-control" value="[grid_blk.nSaldo;frm='0,000.00';noerr;]" readonly>
                                </div>
                            </div>
                             <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Invoice</label>
                                    <input type="text" name="jml" id="jml" class="form-control" value="[grid_blk.jml;noerr;]" readonly>
                                </div>
                            </div>
                       </div>
                      	<div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Payment Date</label>
                                    <input type="text" name="tgl" id="tgl" data-mask="99/99/9999" class="form-control datepicker" value="">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Payment</label>
                                    <input type="text" name="payment" id="payment" onkeyup="setPaymentDetail()" class="form-control result" value="[grid_blk.nSaldo;frm='0,000.00';noerr;]">
                                </div>
                            </div>
                       </div>
                        <div class="table-responsive">
                            <h4>Payment Detail</h4>
                            <table id="tbldetail" name="tbldetail" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="25">Pay</th>
                                        <th>PO Number</th>
                                        <th width="110">PO Date</th>
                                        <th width="110">Due Date</th>
                                        <th width="125">Amount</th>
                                        <th width="125">Return</th>
                                        <th width="125">Total Pay</th>
                                        <th width="125">Remain</th>
                                        <th width="125">Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="checkbox" value="[grid_dtl.nSaldo;block=tr;frm='0,000.00';noerr]" id="chk[]" name="chk[]" checked/></td>
                                    <input type="hidden" name="idpo[]" id="idpo[]" value="[grid_dtl.cIdPO;block=tr;noerr]" class="form-control input-sm" readonly/>
                                    <td><input type="text" name="nopo[]" id="nopo[]" value="[grid_dtl.cNoPO;block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><input type="text" name="podate[]" id="podate[]" value="[grid_dtl.dTglPO;frm='dd/mm/yyyy';block=tr;noerr]" class="form-control  input-sm" readonly/></td>
                                    <td><input type="text" name="duedate[]" id="duedate[]" value="[grid_dtl.dTglJT;frm='dd/mm/yyyy';block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><input type="text" name="amount[]" id="amount[]"  value="[grid_dtl.nGrandTotal;frm='0,000.00';block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><input type="text" name="return[]" id="return[]" value="[grid_dtl.nTotalRetur;frm='0,000.00';block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><input type="text" name="totalpay[]" id="totalpay[]" value="[grid_dtl.nTotalPay;frm='0,000.00';block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><input type="text" name="remain[]" id="remain[]" value="[grid_dtl.nSaldo;block=tr;frm='0,000.00';noerr]" class="form-control input-sm tagihan" readonly/></td>
                                    <td><input type="text" name="pay[]" id="pay[]" value="[grid_dtl.nSaldo;block=tr;frm='0,000.00';noerr]" class="form-control input-sm jumlah" readonly/></td>
                                  </tr>
                                </tbody>
                          </table>
                        </div>
                    </div>

                    <div class="nobg fluid">
                        <button type="submit" id="FormAction" name="FormAction" value="Simpan" class="btn btn-primary">Save</button>
                        <button type="button" id="FormBatal" name="FormBatal" onclick="window.location = 'index.php?m=[var.~moduleid;noerr][var.~page_url;noerr]';" value="Batal" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
      
  </div>
</div>