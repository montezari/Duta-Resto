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
                            <th>Entity</th>
                            <th>Dept</th>
                            <th>Employee Name</th>
                            <th>Group</th>
                            <th colspan="3">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[grid_blk.vNmEntity;noerr;block=tr]</td>
                            <td>[grid_blk.vNmDept;noerr;block=tr]</td>
                            <td>[grid_blk.vNamaPegawai;noerr;block=tr]</td>
                            <td>[grid_blk.vFlag;noerr;block=tr]</td>
                            <td width="25" align="center">[var.button.E;if [var.button.E;noerr]=='valid';then <a href="#" title="Edit Data" class="back" onClick="window.location = '?m=[var.~moduleid;noerr]&mode=form&key=[grid_blk.cKdPegawai;noerr]'"><span class="fa fa-eject"></span></a>;else <span class="fa fa-eject"></span>]</td>
                            <td width="25" align="center">[var.button.D;if [var.button.D;noerr]=='valid';then <a href="#" title="Delete Data" class="back" onClick="ConfirmDelete('[grid_blk.cKdPegawai;noerr]')"><span class="fa fa-trash-o"></span></a>;else <span class="fa fa-trash-o"></span>]</td>
                        </tr>
                        <tr>
                          <td colspan="4">&nbsp;</td>
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
                <input name='fkey' id='fkey' type='hidden' value='[grid_blk.cKdPegawai;noerr;]' size=/>
                    <div class="form-body">
                      	<div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Entity</label>
                                    <select class="form-control" id="cmbentity" name="cmbentity">
                                        <option value=''></option>
                                        <option value='[blk_ent.cKdEntity;noerr;block=option]' [onshow; if [grid_blk.cKdEntity;noerr]==[blk_ent.cKdEntity;noerr];then 'selected';else '']>[blk_ent.vNmEntity;noerr;block=option]</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Departemen</label>
                                    <select class="form-control" id="cmbdept" name="cmbdept">
                                        <option value=''></option>
                                        <option value='[blk_dept.cKdDept;noerr;block=option]' [onshow; if [grid_blk.cKdDept;noerr]==[blk_dept.cKdDept;noerr];then 'selected';else '']>[blk_dept.vNmDept;noerr;block=option]</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Group</label>
                                    <select class="form-control" id="cmbgrp" name="cmbgrp">
                                        <option value=''></option>
                                        <option value='[blk_grp.cId;noerr;block=option]' [onshow; if [grid_blk.cFlag;noerr]==[blk_grp.cId;noerr];then 'selected';else '']>[blk_grp.cName;noerr;block=option]</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Employee Name</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="[grid_blk.vNamaPegawai;noerr;]">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Employee Alias</label>
                                    <input type="text" name="alias" id="alias" class="form-control" value="[grid_blk.vNmSingkat;noerr;]">
                                </div>
                            </div>
                        </div>
                      	<div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">PIN</label>
                                    <input type="password" name="pin" id="pin" class="form-control" value="[grid_blk.cPIN;noerr;]">
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