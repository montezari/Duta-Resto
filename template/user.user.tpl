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
                <table id="table_grid" class="table table-bordered table-hover">
                <form action="index.php?m=[var.~moduleid;noerr][var.~page_url;noerr]" method="post" name='grid'>
                <input name='fkey' id='fkey' type='hidden' size=/>
                    <thead>
                        <tr>
                            <th width="25">#</th>
                            <th>Departemen</th>
                            <th>Nama Pegawai</th>
                            <th>User Name</th>
                            <th>Status</th>
                            <th colspan="2">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[grid_blk.#; block=tr;noerr]</td>
                            <td>[grid_blk.vNmDept;noerr;block=tr]</td>
                            <td>[grid_blk.vNamaPegawai;noerr;block=tr]</td>
                            <td>[grid_blk.cUserName;noerr;block=tr]</td>
                            <td>[grid_blk.cStatus;noerr;if [grid_blk.cStatus;noerr]=='1';then 'Aktif';else 'Tidak Aktif';block=tr]</td>
                            <td width="25" align="center">[var.button.E;if [var.button.E;noerr]=='valid';then <a href="#" class="back" title="Edit Entity User"onClick="window.location = '?m=[var.~moduleid;noerr]&mode=proyek&key=[grid_blk.cKdPegawai;noerr]'"><span class="fa fa-sitemap"></span></a>;else <span class="fa fa-sitemap"></span>]</td>
                            <td width="25" align="center">[var.button.E;if [var.button.E;noerr]=='valid';then <a href="#" class="back" title="Edit User Detail" onClick="window.location = '?m=[var.~moduleid;noerr]&mode=form&key=[grid_blk.cKdPegawai;noerr]'"><span class="fa fa-eject"></span></a>;else <span class="fa fa-eject"></span>]</td>
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
            <!-- general form elements disabled -->
            <div class="box border primary">
                <div class="box-title">
            	</div>
                <div class="box-body">
                    <form name="form" id="form" method="post" action="?m=[var.~moduleid;noerr][var.~page_url;noerr]">
                    <input name='fkey' id='fkey' type='hidden' value='[grid_blk.cUserId;noerr;]' size=/>
                    <input name='kdpeg' id='kdpeg' type='hidden' value='[grid_blk.cKdPegawai;noerr;]' size=/>
                        <!-- text input -->
                        <div class="form-group">
                            <label>Departemen</label>
                            <input type="text" name="nama" id="nama" class="form-control" style="width:250px;" value="[grid_blk.vNmDept;noerr;]" readonly/>
                        </div>
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" name="nama" id="nama" class="form-control" style="width:250px;" value="[grid_blk.vNamaPegawai;noerr;]" readonly/>
                        </div>
                       <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="user" id="user" class="form-control" style="width:250px;" value="[grid_blk.cUserName;noerr;]"/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" id="pass" class="form-control" style="width:250px;" value="[var.cPassword;noerr;]"/>
                        </div>
                        <div class="form-group">
                            <label>User Group</label>
                            <select class="form-control" id="cmbgroup" name="cmbgroup" style="width:250px;">
                                <option value=''></option>
                                <option value='[blk_grp.cKdGroupUser;noerr;block=option]' [onshow; if [grid_blk.cKdGroupUser;noerr]==[blk_grp.cKdGroupUser;noerr];then 'selected';else '']>[blk_grp.vNmGroupUser;noerr;block=option]</option>
                            </select>
                        </div>
                        <div class="form-group"> 
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" id="chkstatus" name="chkstatus" [onshow; if [grid_blk.cStatus;noerr;]=='1';then 'checked'; else '']/>Active</label>                                                
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" id="FormAction" name="FormAction" value="Simpan" class="btn btn-primary">Simpan</button>
                            <button type="button" id="FormBatal" name="FormBatal" onclick="window.location = 'index.php?m=[var.~moduleid;noerr][var.~page_url;noerr]';" value="Batal" class="btn btn-danger">Batal</button>
                        </div>
                    </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>

   		<div id="input_form2">
        [onload_1; when [var.mode;noerr]==2; block=div]
            <!-- general form elements disabled -->
            <div class="box border primary">
                <div class="box-title">
                </div>
                <div class="box-body">
                    <form name="form" id="form" method="post" action="?m=[var.~moduleid;noerr][var.~page_url;noerr]">
                    <input name='fkey' id='fkey' type='hidden' value='[grid_blk.cKdPegawai;noerr;]' size=/>
                    <input name='fname' id='fname' type='hidden' value='[grid_blk.cUserName;noerr;]' size=/>
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" name="namapeg" id="namapeg" class="form-control" style="width:250px;" value="[grid_blk.vNamaPegawai;noerr;]" readonly/>
                        </div>
                       <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" id="username" class="form-control" style="width:250px;" value="[grid_blk.cUserName;noerr;]" readonly/>
                        </div>
                        <div class="box-body table-responsive">
                            <table id="tbl2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="25">#</th>
                                        <th>Entity</th>
                                        <th width="25"><label><input type="checkbox" id="selecctall"/></label> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>[blk_dtl.#; block=tr;noerr]</td>
                                        <td>[blk_dtl.vNmEntity;noerr;block=tr]</td>
                                        <td>
                                		<label><input class="checkbox1" type="checkbox" value="[blk_dtl.cKdEntity;noerr;]" id="cakses[]" name="cakses[]" [onshow; if [blk_dtl.cStatus;block=tr]=='1';then 'checked';else '']/></label>                                              
                                        </td>
                                    </tr>
                                </tbody>
                          </table>
                      </div>
                        
                        <div class="box-footer">
                            <button type="submit" id="FormAction" name="FormAction" value="UpdateProyek" class="btn btn-primary">Simpan</button>
                            <button type="button" id="FormBatal" name="FormBatal" onclick="window.location = 'index.php?m=[var.~moduleid;noerr][var.~page_url;noerr]';" value="Batal" class="btn btn-danger">Batal</button>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
        
    </div>
</div>



