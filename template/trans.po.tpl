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
                            <th>PO No</th>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Total</th>
                            <th>Due Date</th>
                           <th colspan="5">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[grid_blk.cNoPO;noerr;block=tr]</td>
                            <td>[grid_blk.dTglPO;frm='dd/mm/yyyy';noerr;block=tr]</td>
                            <td>[grid_blk.vNmSupplier;noerr;block=tr]</td>
                            <td>[grid_blk.nTotal;frm='0,000.00';noerr;block=tr]</td>
                            <td>[grid_blk.dTglJT;frm='dd/mm/yyyy';noerr;block=tr]</td>
                           <td width="25" align="center">[var.button.D;if [var.button.D;noerr]=='valid';then <a href="#" title="Purchase Retur" class="back" onClick="window.location = '?m=[var.~moduleid;noerr]&act=retur&mode=form&key=[grid_blk.cIdPO;noerr]'"><span class="fa fa-share-square-o"></span></a>;else <span class="fa fa-share-square-o"></span>]</td>
                           <td width="25" align="center">[var.button.D;if [var.button.D;noerr]=='valid';then <a title="Goods Receiving" class="back" href="#" onClick="window.location = '?m=[var.~moduleid;noerr]&act=bbm&mode=form&key=[grid_blk.cIdPO;noerr]'"><span class="fa fa-truck"></span></a>;else <span class="fa fa-truck"></span>]</td>
                           <td width="25" align="center">[var.button.D;if [var.button.D;noerr]=='valid';then <a href="#" title="Print" class="back" onClick=""><span class="fa fa-print"></span></a>;else <span class="fa fa-print"></span>]</td>
                            <td width="25" align="center">[var.button.E;if [var.button.E;noerr]=='valid';then <a href="#" title="Edit Data" class="back" onClick="window.location = '?m=[var.~moduleid;noerr]&mode=form&key=[grid_blk.cIdPO;noerr]'"><span class="fa fa-eject"></span></a>;else <span class="fa fa-eject"></span>]</td>
                            <td width="25" align="center">[var.button.D;if [var.button.D;noerr]=='valid';then <a href="#" title="Delete Data" class="back" onClick="ConfirmDelete('[grid_blk.cIdPO;noerr]')"><span class="fa fa-trash-o"></span></a>;else <span class="fa fa-trash-o"></span>]</td>
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                          <td colspan="5" align="center">[var.button.A;if [var.button.A;noerr]=='valid';then <a href="#" title="Add New Data" class="back" onClick="window.location = '?m=[var.~moduleid;noerr]&mode=form'"><span class="fa fa-plus"></span></a>;else <span class="fa fa-plus"></span>]</td>
                        </tr>
                    </tbody>
                    <input type="hidden" name="FormAction" value="HAPUS">
  					</form>
                </table>
                <!-- modal form -->
                <div id="grmodal" class="modal fade" tabindex="-1" aria-hidden="true">
                	<form action="index.php?m=[var.~moduleid;noerr][var.~page_url;noerr]" method="post" name='modal' id='modal'>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Form Goods Receiving</h4>
                            </div>
                            <div class="modal-body">
                                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
									<div class="row">
										<div class="col-md-6">
                                        	<button type="button" class="btn green">Receive All Goods</button>
                                        </div>
                                    </div>
                                    <hr />
									<div class="row">
										<div class="col-md-6">
                                        	<button type="button" onclick="" class="btn warning">Partially Goods</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn default">Batal</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- end modal form -->
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
                <input name='fkey' id='fkey' type='hidden' value='[grid_blk.cIdPO;noerr;]' size=/>
                <input name='fact' id='fact' type='hidden' value='[var.mode;noerr;]' size=/>
                    <div class="form-body">
                      	<div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">PO Number</label>
                                    <input type="text" name="nomor" id="nomor" class="form-control" value="[grid_blk.cNoPO;noerr;]" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="text" name="tgl" id="tgl" data-mask="99/99/9999" class="form-control datepicker" value="[grid_blk.dTglPO;frm='dd/mm/yyyy';noerr;]">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Supplier</label>
									<input type="hidden" name="kodesupp" id="kodesupp" class="form-control" value="[grid_blk.cKdSupplier;noerr;]">                                    <input type="text" name="namasupp" id="namasupp" class="form-control" value="[grid_blk.vNmSupplier;noerr;]">
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="ket" id="ket" class="form-control" rows="4">[grid_blk.cKeterangan;noerr;]</textarea>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Term Pay</label>
                                    <input type="text" name="termpay" id="termpay" class="form-control input-inline input-medium" value="[grid_blk.cTermPay;noerr;]">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Pay Method</label>
                                    <select class="form-control" id="jenis" name="jenis">
                                        <option value='[blk_jns.key;noerr;block=option]' [onshow; if [grid_blk.cJenisPay;noerr]==[blk_jns.key;noerr];then 'selected';else '']>[blk_jns.val;noerr;block=option]</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Total</label>
                                    <input type="text" name="result" id="result" class="form-control result" value="[grid_blk.nTotal;noerr;]" readonly>
                                	<input type="checkbox" value="T" id="pajak" name="pajak" onclick="getpajak()" [onshow; if [grid_blk.cPajak;noerr;]=='T';then 'checked';else '']/>
                                	<label class="control-label">Tax</label>
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Discount (%)</label>
                                    <input type="text" name="discpers" id="discpers" class="form-control discpers" value="[grid_blk.nPersDiskon;noerr;]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Discount (Rp)</label>
                                    <input type="text" name="disc" id="disc" class="form-control disc" value="[grid_blk.nDiskon;noerr;]">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Grand Total</label>
                                    <input type="hidden" name="biayalain" id="biayalain" class="form-control tax" value="[grid_blk.nBiayaLain;noerr;]">
                                    <input type="hidden" name="tax" id="tax" class="form-control tax" value="[grid_blk.nPajak;noerr;]">
                                    <input type="hidden" name="taxpers" id="taxpers" class="form-control taxpers" value="[grid_blk.nPersPajak;noerr;]">
                                    <input type="text" name="grandtotal" id="grandtotal" class="form-control grandtotal" value="[grid_blk.nGrandTotal;noerr;]" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <h4>Items Detail</h4>
                            <table id="tbldetail" name="tbldetail" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th width="100">Qty</th>
                                        <th width="100">Unit</th>
                                        <th width="150">Price</th>
                                        <th width="150">Total</th>
                                        <th width="25">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <input type="hidden" name="kd_barang" id="kd_barang" class="form-control input-sm"/>
                                    <td><div class="has-success"><input type="text" name="nm_barang" id="nm_barang" class="form-control input-sm" placeholder="Input nama barang"/></div></td>
                                    <td><div class="has-success"><input type="text" name="val_qty" id="val_qty" class="form-control input-sm numeric qty"/></div></td>
                                    <input type="hidden" name="kd_satuan" id="kd_satuan" class="form-control input-sm"/>
                                    <td><div class="has-success"><input type="text" name="nm_satuan" id="nm_satuan" class="form-control input-sm" readonly/></div></td>
                                    <td><div class="has-success"><input type="text" name="harga" id="harga" class="form-control input-sm harga"/></div></td>
                                    <td><div class="has-success"><input type="text" name="jumlah" id="jumlah" class="form-control input-sm jumlah" readonly/></div></td>
                                    <td><a href="#" name="add_button" id="add_button"><span class="fa fa-plus"></span></a></td>
                                </tr>
                                <tr id="tr[grid_dtl.cIdPODt;block=tr;noerr]">
                                    <input type="hidden" name="kd_barang[]" id="kd_barang[]" value="[grid_dtl.cKdBarang;block=tr;noerr]" class="form-control input-sm"/>
                                    <td><input type="text" name="nm_barang[]" id="nm_barang[]" value="[grid_dtl.vNamaBarang;block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><input type="text" name="val_qty[]" id="val_qty[]" value="[grid_dtl.nQtyBeli;block=tr;noerr]" class="form-control  input-sm numeric valqty"/></td>
                                    <input type="hidden" name="kd_satuan[]" id="kd_satuan[]" value="[grid_dtl.cSatuan;block=tr;noerr]" class="form-control input-sm"/>
                                    <td><input type="text" name="nm_satuan[]" id="nm_satuan[]" value="[grid_dtl.cAlias;block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><input type="text" name="harga[]" id="harga[]"  value="[grid_dtl.nHarga;block=tr;noerr]" class="form-control input-sm valharga"/></td>
                                    <td><input type="text" name="jumlah[]" id="jumlah[]" value="[grid_dtl.nTotalHarga;block=tr;noerr]" class="form-control input-sm valjumlah" readonly/></td>
                                    <td><a href="javascript:dodelete([grid_dtl.cIdPODt;block=tr;noerr]);"><span class="fa fa-trash-o"></span></a></td>
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

    <div id="input_form">
    <!-- GOODS RECEIVING-->
    [onload_1; when [var.mode;noerr]==2; block=div]
        <div class="box border primary">
        	<div class="box-title">
            </div>
            <div class="box-body">
                <!-- BEGIN FORM-->
               <form name="form" id="form" method="post" action="?m=[var.~moduleid;noerr][var.~page_url;noerr]">
                <input name='fkey' id='fkey' type='hidden' value='[grid_blk.cIdPO;noerr;]' size=/>
                <input name='nopo' id='nopo' type='hidden' value='[grid_blk.cNoPO;noerr;]' size=/>
                <input name='tglpo' id='tglpo' type='hidden' value='[grid_blk.dTglPO;noerr;]' size=/>
                <input name='fact' id='fact' type='hidden' value='[grid_blk.cFlag;noerr;]' size=/>
                    <div class="form-body">
                      	<div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">PO Number</label>
                                    <input type="text" name="nomor" id="nomor" class="form-control" value="[grid_blk.cNoPO;noerr;]" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">PO Date</label>
                                    <input type="text" name="tgl_po" id="tgl_po" data-mask="99/99/9999" class="form-control datepicker" value="[grid_blk.dTglPO;frm='dd/mm/yyyy';noerr;]" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Supplier</label>
									<input type="hidden" name="kodesupp" id="kodesupp" class="form-control" value="[grid_blk.cKdSupplier;noerr;]" readonly>                                    <input type="text" name="namasupp" id="namasupp" class="form-control" value="[grid_blk.vNmSupplier;noerr;]" readonly>
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">GR Date</label>
                                    <input type="text" name="tgl" id="tgl" data-mask="99/99/9999" class="form-control datepicker" value="">
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="ket" id="ket" class="form-control" rows="3">[grid_blk.cKeterangan;noerr;]</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <h4>Items Detail</h4>
                            <table id="tbldetail" name="tbldetail" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th width="100">Qty PO</th>
                                        <th width="100">RETURN</th>
                                        <th width="100">TOTAL GR</th>
                                        <th width="100">GR</th>
                                        <th width="100">Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr id="tr[grid_dtl.cIdPODt;block=tr;noerr]">
                                    <input type="hidden" name="id_podt[]" id="id_podt[]" value="[grid_dtl.cIdPODt;block=tr;noerr]" class="form-control input-sm"/>
                                    <input type="hidden" name="kd_barang[]" id="kd_barang[]" value="[grid_dtl.cKdBarang;block=tr;noerr]" class="form-control input-sm"/>
                                    <td><input type="text" name="nm_barang[]" id="nm_barang[]" value="[grid_dtl.vNamaBarang;block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><input type="text" name="val_qty[]" id="val_qty[]" value="[grid_dtl.nQtyBeli;block=tr;noerr]" class="form-control  input-sm numeric valqty" readonly/></td>
                                    <td><input type="text" name="val_retur[]" id="val_retur[]" value="[grid_dtl.nQtyRetur;block=tr;noerr]" class="form-control  input-sm" readonly/></td>
                                    <td><input type="text" name="val_gr[]" id="val_gr[]" value="[grid_dtl.nQtyBBM;block=tr;noerr]" class="form-control  input-sm" readonly/></td>
                                    <td><input type="text" name="val_saldo[]" id="val_saldo[]" value="[grid_dtl.nQtySaldo;block=tr;noerr]" class="form-control  input-sm"/></td>
                                    <input type="hidden" name="kd_satuan[]" id="kd_satuan[]" value="[grid_dtl.cSatuan;block=tr;noerr]" class="form-control input-sm"/>
                                    <td><input type="text" name="nm_satuan[]" id="nm_satuan[]" value="[grid_dtl.cAlias;block=tr;noerr]" class="form-control input-sm" readonly/></td>
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

    <div id="input_form">
    <!-- RETURN -->
    [onload_1; when [var.mode;noerr]==3; block=div]
        <div class="box border primary">
        	<div class="box-title">
            </div>
            <div class="box-body">
                <!-- BEGIN FORM-->
               <form name="form" id="form" method="post" action="?m=[var.~moduleid;noerr][var.~page_url;noerr]">
                <input name='fkey' id='fkey' type='hidden' value='[grid_blk.cIdPO;noerr;]' size=/>
                <input name='nopo' id='nopo' type='hidden' value='[grid_blk.cNoPO;noerr;]' size=/>
                <input name='tglpo' id='tglpo' type='hidden' value='[grid_blk.dTglPO;noerr;]' size=/>
                <input name='fact' id='fact' type='hidden' value='[grid_blk.cFlag;noerr;]' size=/>
                    <div class="form-body">
                      	<div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">PO Number</label>
                                    <input type="text" name="nomor" id="nomor" class="form-control" value="[grid_blk.cNoPO;noerr;]" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">PO Date</label>
                                    <input type="text" name="tgl_po" id="tgl_po" data-mask="99/99/9999" class="form-control datepicker" value="[grid_blk.dTglPO;frm='dd/mm/yyyy';noerr;]" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Supplier</label>
									<input type="hidden" name="kodesupp" id="kodesupp" class="form-control" value="[grid_blk.cKdSupplier;noerr;]" readonly>                                    <input type="text" name="namasupp" id="namasupp" class="form-control" value="[grid_blk.vNmSupplier;noerr;]" readonly>
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Return Date</label>
                                    <input type="text" name="tgl" id="tgl" data-mask="99/99/9999" class="form-control datepicker" value="">
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="ket" id="ket" class="form-control" rows="3">[grid_blk.cKeterangan;noerr;]</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <h4>Items Detail</h4>
                            <table id="tbldetail" name="tbldetail" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th width="100">Qty PO</th>
                                        <th width="100">GR</th>
                                        <th width="100">TOTAL RETURN</th>
                                        <th width="100">RETURN</th>
                                        <th width="100">Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr id="tr[grid_dtl.cIdPODt;block=tr;noerr]">
                                    <input type="hidden" name="id_podt[]" id="id_podt[]" value="[grid_dtl.cIdPODt;block=tr;noerr]" class="form-control input-sm"/>
                                    <input type="hidden" name="kd_barang[]" id="kd_barang[]" value="[grid_dtl.cKdBarang;block=tr;noerr]" class="form-control input-sm"/>
                                    <td><input type="text" name="nm_barang[]" id="nm_barang[]" value="[grid_dtl.vNamaBarang;block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><input type="text" name="val_qty[]" id="val_qty[]" value="[grid_dtl.nQtyBeli;block=tr;noerr]" class="form-control  input-sm numeric valqty" readonly/></td>
                                    <td><input type="text" name="val_gr[]" id="val_gr[]" value="[grid_dtl.nQtyBBM;block=tr;noerr]" class="form-control  input-sm" readonly/></td>
                                    <td><input type="text" name="val_retur[]" id="val_retur[]" value="[grid_dtl.nQtyRetur;block=tr;noerr]" class="form-control  input-sm" readonly/></td>
                                    <td><input type="text" name="val_saldo[]" id="val_saldo[]" value="[grid_dtl.nQtySaldo;block=tr;noerr]" class="form-control  input-sm"/></td>
                                    <input type="hidden" name="kd_satuan[]" id="kd_satuan[]" value="[grid_dtl.cSatuan;block=tr;noerr]" class="form-control input-sm"/>
                                    <td><input type="text" name="nm_satuan[]" id="nm_satuan[]" value="[grid_dtl.cAlias;block=tr;noerr]" class="form-control input-sm" readonly/></td>
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