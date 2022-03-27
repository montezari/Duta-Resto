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
                <input name='fbarang' id='fbarang' type='hidden' size=/>
                <input name='fid' id='fid' type='hidden' size=/>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th colspan="4">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[grid_blk.vNamaBarang;noerr;block=tr]</td>
                            <td>[grid_blk.cKeterangan;noerr;block=tr]</td>
                            <td>[grid_blk.vStatus;noerr;block=tr]</td>
                            <td width="25" align="center">[var.button.D;if [var.button.D;noerr]=='valid';then <a href="#" title="Set Active" class="back" onClick="SetActive('[grid_blk.cKdRecipe;noerr]','[grid_blk.cKdBarang;noerr]')"><span class="fa fa-check"></span></a>;else <span class="fa fa-check"></span>]</td>
                            <td width="25" align="center">[var.button.E;if [var.button.E;noerr]=='valid';then <a href="#" title="Edit Data" class="back" onClick="window.location = '?m=[var.~moduleid;noerr]&mode=form&key=[grid_blk.cKdRecipe;noerr]'"><span class="fa fa-eject"></span></a>;else <span class="fa fa-eject"></span>]</td>
                            <td width="25" align="center">[var.button.D;if [var.button.D;noerr]=='valid';then <a href="#" title="Delete Data" class="back" onClick="ConfirmDelete('[grid_blk.cKdRecipe;noerr]')"><span class="fa fa-trash-o"></span></a>;else <span class="fa fa-trash-o"></span>]</td>
                        </tr>
                        <tr>
                          <td colspan="3">&nbsp;</td>
                          <td colspan="3" align="center">[var.button.A;if [var.button.A;noerr]=='valid';then <a href="#" title="Add New Data" class="back" onClick="window.location = '?m=[var.~moduleid;noerr]&mode=form'"><span class="fa fa-plus"></span></a>;else <span class="fa fa-plus"></span>]</td>
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
                <input name='fkey' id='fkey' type='hidden' value='[grid_blk.cKdRecipe;noerr;]' size=/>
                    <div class="form-body">
                      	<div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Item Name</label>
									<input type="hidden" name="kode" id="kode" class="form-control" value="[grid_blk.cKdBarang;noerr;]">                                    <input type="text" name="nama" id="nama" class="form-control" value="[grid_blk.vNamaBarang;noerr;]">
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
                            <div class="col-md-2">
                                <div class="form-group"> 
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="T" id="chkstatus" name="chkstatus" [onshow; if [grid_blk.cStatus;noerr;]=='T';then 'checked';else '']/>
                                            Active
                                        </label>                                                
                                    </div>
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
                                        <th width="25">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <input type="hidden" name="kd_barang" id="kd_barang" class="form-control input-sm"/>
                                    <td><div class="has-success"><input type="text" name="nm_barang" id="nm_barang" class="form-control input-sm" placeholder="Input nama barang"/></div></td>
                                    <td><div class="has-success"><input type="text" name="val_qty" id="val_qty" class="form-control input-sm numeric"/></div></td>
                                    <input type="hidden" name="kd_satuan" id="kd_satuan" class="form-control input-sm"/>
                                    <td><div class="has-success"><input type="text" name="nm_satuan" id="nm_satuan" class="form-control input-sm" readonly/></div></td>
                                    <td><a href="#" name="add_button" id="add_button"><span class="fa fa-plus"></span></a></td>
                                </tr>
                                <tr id="tr[grid_dtl.cKdRecipeDt;block=tr;noerr]">
                                    <input type="hidden" name="kd_barang[]" id="kd_barang[]" value="[grid_dtl.cKdBarang;block=tr;noerr]" class="form-control input-sm"/>
                                    <td><input type="text" name="nm_barang[]" id="nm_barang[]" value="[grid_dtl.vNamaBarang;block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><input type="text" name="val_qty[]" id="val_qty[]" value="[grid_dtl.nQty;block=tr;noerr]" class="form-control  input-sm numeric"/></td>
                                    <input type="hidden" name="kd_satuan[]" id="kd_satuan[]" value="[grid_dtl.cSatuan;block=tr;noerr]" class="form-control input-sm"/>
                                    <td><input type="text" name="nm_satuan[]" id="nm_satuan[]" value="[grid_dtl.cAlias;block=tr;noerr]" class="form-control input-sm" readonly/></td>
                                    <td><a href="javascript:dodelete([grid_dtl.cKdRecipeDt;block=tr;noerr]);"><span class="fa fa-trash-o"></span></a></td>
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