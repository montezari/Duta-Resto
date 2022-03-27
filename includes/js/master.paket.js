/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    var url = 'uploads/',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                	$this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        singleFileUploads: true,
		maxNumberOfFiles: 1,
		previewMaxWidth: 200,
        previewMaxHeight: 200,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
		$('#files').empty();
		data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>');
			node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                $('#gbr').val(file.name);
				var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

function ConfirmDelete(val){
  if(confirm('Are you sure you want to delete this data?')){
     $('#fkey').val(val); 
	 $("form[name='grid']").submit();
  }  
}

function dodelete(buttonId){
  if(confirm('Are you sure you want to delete this detail data?')){
    $("#tr"+buttonId).remove();	
  }
}

 var itemCount = 0;
$(document).ready(function() {
	$('#harga').number(true, 2 );
	var objs=[];
	var temp_objs=[];
	$( "#add_button" ).click(function() {	
		var html = "";
		var obj={
			"ROW_ID" : itemCount,
			"KODE_BARANG" :  $("#kd_barang").val(),
			"NAMA_BARANG" :  $("#nm_barang").val(),
			"QUANTITY" : $("#val_qty").val(),
			"KODE_SATUAN" : $("#kd_satuan").val(),
			"SATUAN" : $("#nm_satuan").val()
		}   
		if(obj['KODE_BARANG']!="") {
		objs.push(obj);
		itemCount--;
		html = "<tr id='tr"+itemCount+"'>"+
			   "<input type='hidden' name='kd_barang[]' id='kd_barang[]' value='"+obj['KODE_BARANG']+"' class='form-control input-sm'/>"+ 	
		       "<td><input type='text' class='form-control input-sm' name='nm_barang[]' id='nm_barang[]' value='"+obj['NAMA_BARANG']+"' readonly/></td>"+
			   "<td><input type='text' class='form-control input-sm numeric' name='val_qty[]' id='val_qty[]' value='"+obj['QUANTITY']+"'/></td>"+
			   "<input type='hidden' name='kd_satuan[]' id='kd_satuan[]' class='form-control input-sm'  value='"+obj['KODE_SATUAN']+"'/>"+
			   "<td><input type='text' class='form-control input-sm' name='nm_satuan[]' id='nm_satuan[]' value='"+obj['SATUAN']+"' readonly/></td>"+
			   "<td><a href='javascript:dodelete("+itemCount+")'><span class='glyphicon glyphicon-trash'></span></a></td></tr>";	
		$("#tbldetail").append(html);
	    $('#kd_barang').val("");
	    $('#nm_barang').val("");
	    $('#val_qty').val("");
	    $('#kd_satuan').val("");
	    $('#nm_satuan').val("");
		}else{
		 if(obj['KODE_BARANG']!=""){
		    alert('Nama barang harus di isi.');
		  }else{
		    alert('Nama barang tidak valid.');
		  }
		  
		}
	});

  var cols = [{'columnName':'cKdBarang','width':'10','label':'Kode'}, 
			  {'columnName':'vNamaBarang','width':'30','label':'Nama'},
			  {'columnName':'vNmGrupBarang','width':'30','label':'Group'},
			  {'columnName':'cSatuan','width':'0','hidden': true,'label':'cSatuan'},
			  {'columnName':'cAlias','width':'30','label':'Satuan'}
			 ];	
				
  $( "#nm_barang" ).bind('keyup', function(){
	  if($( "#nm_barang" ).val().length==0){
		  $('#kd_barang').val("");
		  $('#kd_satuan').val("");
		  $('#nm_satuan').val("");
	  }
  });
  
  $( "#nm_barang" ).combogrid({
	  debug:true,
	  colModel: cols,
	  url: 'ajax/barang.php',
	  select: function( event, ui ) {
		  $( "#kd_barang" ).val( ui.item.cKdBarang );
		  $( "#nm_barang" ).val( ui.item.vNamaBarang );
		  $( "#kd_satuan" ).val( ui.item.cSatuan );
		  $( "#nm_satuan" ).val( ui.item.cAlias );
		  return false;
	  }
  });


	$('#form').bootstrapValidator({
        message: 'Nilai tidak valid',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            nama: {
                message: 'Inputan tidak valid',
                validators: {
                    notEmpty: {
                        message: 'Inputan tidak boleh kosong dan harus di isi'
                    },
                    stringLength: {
                        min: 1,
                        max: 100,
                        message: 'Inputan maksimal 100 karakter'
                    }
                }
            },
            kode: {
                message: 'Inputan tidak valid',
                validators: {
                    notEmpty: {
                        message: 'Inputan tidak boleh kosong dan harus di isi'
                    },
                    stringLength: {
                        min: 1,
                        max: 30,
                        message: 'Inputan maksimal 30 karakter'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'Inputan tidak valid'
                    },
                    remote: {
                        url: 'validate.php?m=master.paket',
                        message: 'Inputan sudah ada'
                    }
                }
            }
		}
    });
});
