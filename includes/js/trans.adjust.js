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

// barang detail
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


});
