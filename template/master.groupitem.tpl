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
                            <th>Group Code</th>
                            <th>Group Name</th>
                            <th colspan="3">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[grid_blk.cKdGrupBarang;noerr;block=tr]</td>
                            <td>[grid_blk.vNmGrupBarang;noerr;block=tr]</td>
                            <td width="25" align="center">[var.button.E;if [var.button.E;noerr]=='valid';then <a href="#" title="Edit Data" class="back" onClick="window.location = '?m=[var.~moduleid;noerr]&mode=form&key=[grid_blk.cKdGrupBarang;noerr]'"><span class="fa fa-eject"></span></a>;else <span class="fa fa-eject"></span>]</td>
                            <td width="25" align="center">[var.button.D;if [var.button.D;noerr]=='valid';then <a href="#" title="Delete Data" class="back" onClick="ConfirmDelete('[grid_blk.cKdGrupBarang;noerr]')"><span class="fa fa-trash-o"></span></a>;else <span class="fa fa-trash-o"></span>]</td>
                        </tr>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                          <td colspan="2" align="center">[var.button.A;if [var.button.A;noerr]=='valid';then <a href="#" title="Add New Data" class="back" onClick="window.location = '?m=[var.~moduleid;noerr]&mode=form'"><span class="fa fa-plus"></span></a>;else <span class="fa fa-plus"></span>]</td>
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
                <input name='fkey' id='fkey' type='hidden' value='[grid_blk.cKdGrupBarang;noerr;]' size=/>
                    <div class="form-body">
                      	<div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Group Code</label>
                                    <input type="text" name="kode" id="kode" class="form-control" value="[grid_blk.cKdGrupBarang;noerr;]" [onshow; if [grid_blk.cKdGrupBarang;noerr;]!='';then 'disabled';else '']>
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Group Name</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="[grid_blk.vNmGrupBarang;noerr;]">
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-2">
                                <div class="form-group"> 
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="T" id="showandro" name="showandro" [onshow; if [grid_blk.cShowAndroid;noerr;]=='T';then 'checked';else '']/>
                                            Show On Android
                                        </label>                                                
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group"> 
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="T" id="paket" name="paket" [onshow; if [grid_blk.cPaket;noerr;]=='T';then 'checked';else '']/>
                                            Package
                                        </label>                                                
                                    </div>
                                 </div>
                            </div>
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