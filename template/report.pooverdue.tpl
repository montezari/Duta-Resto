<div class="row">
    <div class="col-md-12">
        <div class="box border primary">
            <div class="box-title">
            </div>
            <div class="box-body">
                <!-- BEGIN FORM-->
                <form name="form" id="form" method="post" action="?m=[var.~moduleid;noerr][var.~page_url;noerr]">
                    <div class="form-body">
                    	<div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Supplier</label>
                                    <select class="form-control" id="supp" name="supp">
                                        <option value='ALL'>ALL</option>
                                        <option value='[blk_supp.cKdSupplier;noerr;block=option]' [onshow; if [var.bulanawal;noerr]==[blk_supp.cKdSupplier;noerr];then 'selected';else '']>[blk_supp.vNmSupplier;noerr;block=option]</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-md-12">
                                <div id="panel" class="progress" style="display:none;">
                                    <div class="progress-bar progress-bar-success" id="progressBar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nobg fluid">
                        <button type="button" id="FormExcel" name="FormExcel" onclick="doexpexcel('[var.~moduleid;noerr]');" value="Export Excel" class="btn btn-info"><i class="fa fa-windows"></i> Export To Excel</button>
                        <button type="button" id="FormCetak" name="FormCetak" onclick="docetak();" value="Cetak" class="btn btn-success hidden-print"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>

</div>