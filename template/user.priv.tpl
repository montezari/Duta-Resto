<div class="row">
    <div class="col-xs-12">
        <div class="box">
        [onload_1; when [var.mode;noerr]==0; block=div]
         <div class="box border primary">
            <div class="box-title">
                <div>Jumlah Data : [var.~recordcount;noerr]</div>
                <div>Halaman : [var.~page_sequence;noerr]</div>
            </div>
            <div class="box-body table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                <form action="index.php?m=[var.~moduleid;noerr]" method="post" name='grid'>
                <input name='fkey' id='fkey' type='hidden' size=/>
                    <thead>
                        <tr>
                            <th width="25">#</th>
                            <th>Nama Group</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[grid_blk.#; block=tr;noerr]</td>
                            <td>[grid_blk.vNmGroupUser;noerr;block=tr]</td>
                            <td>[grid_blk.cAktif;noerr;if [grid_blk.cAktif;noerr]=='1';then 'Aktif';else 'Tidak Aktif';block=tr]</td>
                            <td width="25" align="center">[var.button.E;if [var.button.E;noerr]=='valid';then <a href="#" title="Setup Privileges User" class="back" onClick="window.location = '?m=[var.~moduleid;noerr]&mode=form&key=[grid_blk.cKdGroupUser;noerr]'"><span class="fa fa-eject"></span></a>;else <span class="fa fa-eject"></span>]</td>
                        </tr>
                    </tbody>
  					</form>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->    
        
    <div id="input_form">
        [onload_1; when [var.mode;noerr]==1; block=div]
            <!-- general form elements disabled -->
            <div class="box border primary">
                <div class="box-title">
                </div>
                <div class="box-body">
                    <form name="form" method="post" action="?m=[var.~moduleid;noerr]">
                    <input name='fkey' id='fkey' type='hidden' value='[grid_blk.cKdGroupUser;noerr;]' size=/>
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="vNmGroupUser" id="vNmGroupUser" class="form-control" style="width:250px;" value="[grid_blk.vNmGroupUser;noerr;]" readonly/>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th width="20">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>	
                                        <td>
                                        <span style="[onshow; if [blk_dtl.cpar;block=tr]=='0';then padding-left:20px; ;else font-weight:bold; ] ">[blk_dtl.fcaption;noerr;block=tr]</span></td>
                                        <td>
		                                [onshow; if [blk_dtl.cpar;block=tr]=='0';then 
                                        <label><input type="checkbox" value="[blk_dtl.fmenu;noerr;]" id="cview[]" name="cview[]" [onshow; if [blk_dtl.cView;block=tr]=='1';then 'checked';else '']/></label>;else &nbsp;]                                                
										</td>
                                    </tr>
                                </tbody>
                          </table>
                      </div>
                      <div class="box-footer">
                            <button type="submit" id="FormAction" name="FormAction" value="Simpan" class="btn btn-primary">Simpan</button>
                            <button type="button" id="FormBatal" name="FormBatal" onclick="window.location = 'index.php?m=[var.~moduleid;noerr]';" value="Batal" class="btn btn-danger">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>



