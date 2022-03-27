function docetak(){
	tglawal = $('#tglawal').val();
	tglakhir = $('#tglakhir').val();
	var _url = "pdf.php?export=pdf&id=report.sales&tglawal="+tglawal+"&tglakhir="+tglakhir;
	//window.location = _url;
	//alert(_url);
}

function updateProgress(nilai){
	if(nilai > 100) nilai = 100;
	$('#panel').css('display','none');
	if(nilai>0){
	  $('#panel').css('display','block');
	} 
    $('#progressBar').css('width', nilai+'%');
    /*$('#progressBar').html(nilai+'%');*/
    $('#progressBar').html('Mohon tunggu, data sedang di proses...');
}

function progbar(_url) {
    $.ajax({
      url: _url,
      timeout: 50000,
	  complete: function(xhr, textStatus){
		if (textStatus != "success") {
	  	  updateProgress(100);
		  progbar();
	    }else{
	  	  updateProgress(0);
	    }		
	  }
    });
}

function doexpexcel(modulid){ 
	blnawal = $('#blnawal').val();
	blnakhir = $('#blnakhir').val();
	tahun = $('#tahun').val();
	var _url = "excel.php?export=xlsx&id="+modulid+"&blnawal="+blnawal+"&blnakhir="+blnakhir+"&tahun="+tahun;
	$('#panel').css('display', 'block');
	progbar(_url);
	window.location = _url;
	//alert(_url);
}

$(document).ready(function() {

	$('#form').bootstrapValidator({
        message: 'Nilai tidak valid',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            blnawal: {
                message: 'Inputan tidak valid',
                validators: {
                    notEmpty: {
                        message: 'Inputan tidak boleh kosong dan harus di isi'
                    }
                }
            },
            blnakhir: {
                message: 'Inputan tidak valid',
                validators: {
                    notEmpty: {
                        message: 'Inputan tidak boleh kosong dan harus di isi'
                    }
                }
            },
            tahun: {
                message: 'Inputan tidak valid',
                validators: {
                    notEmpty: {
                        message: 'Inputan tidak boleh kosong dan harus di isi'
                    }
                }
            }
		}
    });
});
