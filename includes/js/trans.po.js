function ConfirmDelete(val){
  if(confirm('Are you sure you want to delete this data?')){
     $('#fkey').val(val); 
	 $("form[name='grid']").submit();
  }  
}

function dodelete(buttonId){
  var grandtotal=0;
  var jumlah=0;
  if(confirm('Are you sure you want to delete this detail data?')){
    var thisRow = $("#tr"+buttonId);
    jumlah = $(thisRow).find(".valjumlah").val(); 
	if (isNaN(jumlah) && jumlah.length == 0) {
	  jumlah = 0;
	}
	grandtotal = $('#result').val();
	grandtotal = grandtotal-jumlah;
	$('#result').val(grandtotal);
	thisRow.remove();	
  }
}

 var itemCount = 0;
$(document).ready(function() {
	var objs=[];
	var temp_objs=[];
	var grandtotal=0;
	$( "#add_button" ).click(function() {	
		var html = "";
		var obj={
			"ROW_ID" : itemCount,
			"KODE_BARANG" :  $("#kd_barang").val(),
			"NAMA_BARANG" :  $("#nm_barang").val(),
			"QUANTITY" : $("#val_qty").val(),
			"KODE_SATUAN" : $("#kd_satuan").val(),
			"SATUAN" : $("#nm_satuan").val(),
			"HARGA" : $("#harga").val(),
			"JUMLAH" : $("#jumlah").val()
		}   
		if(obj['KODE_BARANG']!="") {
		objs.push(obj);
		itemCount--;
		html = "<tr id='tr"+itemCount+"'>"+
			   "<input type='hidden' name='kd_barang[]' id='kd_barang[]' value='"+obj['KODE_BARANG']+"' class='form-control input-sm'/>"+ 	
		       "<td><input type='text' class='form-control input-sm' name='nm_barang[]' id='nm_barang[]' value='"+obj['NAMA_BARANG']+"' readonly/></td>"+
			   "<td><input type='text' class='form-control input-sm numeric valqty' name='val_qty[]' id='val_qty[]' value='"+obj['QUANTITY']+"'/></td>"+
			   "<input type='hidden' name='kd_satuan[]' id='kd_satuan[]' class='form-control input-sm'  value='"+obj['KODE_SATUAN']+"'/>"+
			   "<td><input type='text' class='form-control input-sm' name='nm_satuan[]' id='nm_satuan[]' value='"+obj['SATUAN']+"' readonly/></td>"+
			   "<td><input type='text' class='form-control input-sm valharga' name='harga[]' id='harga[]' value='"+obj['HARGA']+"'/></td>"+
			   "<td><input type='text' class='form-control input-sm valjumlah' name='jumlah[]' id='jumlah[]' value='"+obj['JUMLAH']+"' readonly/></td>"+
			   "<td><a href='javascript:dodelete("+itemCount+")'><span class='glyphicon glyphicon-trash'></span></a></td></tr>";	
		$("#tbldetail").append(html);
		if (!isNaN($('#result').val()) && $('#result').val().length != 0) {
          grandtotal = parseFloat($('#result').val());
		}else{
		  grandtotal = 0;
		}
		if (!isNaN($('#jumlah').val()) && $('#jumlah').val().length != 0) {
          jumlah = parseFloat($('#jumlah').val());
		}else{
		  jumlah = 0;
		}

		grandtotal = grandtotal+jumlah;
		$('#result').val(grandtotal);
		getpajak();

		$('#kd_barang').val("");
	    $('#nm_barang').val("");
	    $('#val_qty').val("");
	    $('#kd_satuan').val("");
	    $('#nm_satuan').val("");
	    $('#harga').val("");
	    $('#jumlah').val("");
		
		}else{
		 if(obj['KODE_BARANG']!=""){
		    alert('Nama barang harus di isi.');
		  }else{
		    alert('Nama barang tidak valid.');
		  }
		  
		}
	});

// supplier
  var colh = [{'columnName':'cKdSupplier','width':'30','label':'Kode'},
			  {'columnName':'vNmSupplier','width':'70','label':'Nama'}
			 ];	
				
  $( "#namasupp" ).bind('keyup', function(){
	  if($( "#namasupp" ).val().length==0){
		  $('#kodesupp').val("");
	  }
  });
  
  $( "#namasupp" ).combogrid({
	  debug:true,
	  colModel: colh,
	  url: 'ajax/supplier.php',
	  select: function( event, ui ) {
		  $( "#kodesupp" ).val( ui.item.cKdSupplier );
		  $( "#namasupp" ).val( ui.item.vNmSupplier );
		  return false;
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

// perhitungan grid
  $(document).ready(function(){
    $("input").each(function() {
		$(this).keyup(function(){
            newSum.call(this);
        });
    });
	$(document).on("keyup", ".valqty", gridSum);
	$(document).on("keyup", ".valharga", gridSum);
  });

  function newSum() {
    var sum=0;
	var qty;
	var harga;
    var thisRow = $(this).closest('tr');
    
    $(thisRow).find("td:not(.jumlah) .qty").each(function() {
	  if (!isNaN(this.value) && this.value.length != 0) {
		qty = parseFloat(this.value);                     
      }else{
	    qty = 0;
	  }
	}); 
    $(thisRow).find("td:not(.jumlah) .harga").each(function() {
	  if (!isNaN(this.value) && this.value.length != 0) {
		harga = parseFloat(this.value);
	  }else{
	    harga = 0;
	  }
    }); 
	sum=qty*harga;
    $(thisRow).find(".jumlah").val(sum);
  }

  function validval(param){
	var value;
	if (!isNaN(param) && param.length != 0) {
	  value = parseFloat(param);
    }else{
	  value = 0;
    }
    return value;    
  }
  
  $(document).ready(function(){
    $("#discpers").keyup(function() {
      getdiskon();
	});
    $("#disc").keyup(function() {
      getdiskonpers();
	});
  });

  function getdiskon() {
 	var diskon, discpers;
	var pajak, pajakpers;
	var total=0;
	var grandtotal=0;

    total = validval($('.result').val());
	discpers = validval($('.discpers').val());
	diskon = (discpers/100)*total;
	$('.disc').val(diskon);
	pajak = validval($('.tax').val());
	grandtotal = total-diskon+pajak;
    $('.grandtotal').val(grandtotal);
  }

  function getdiskonpers() {
 	var diskon, discpers;
	var pajak, pajakpers;
	var total=0;
	var grandtotal=0;

    discpers = 0;
	total = validval($('.result').val());
	diskon = validval($('.disc').val());
	if(total>0){
	  discpers = (diskon/total)*100;
	}
	$('.discpers').val(discpers);
	pajak = validval($('.tax').val());
	grandtotal = total-diskon+pajak;
    $('.grandtotal').val(grandtotal);
  }

  function getpajak() {
 	var diskon, discpers;
	var pajak, pajakpers;
	var total=0;
	var grandtotal=0;
		
	pajak = 0;
	total = validval($('.result').val());
	diskon = validval($('.disc').val());
	if ($('#pajak').prop('checked')) {
	  $('.taxpers').val("10");
	  if(total>0){
	    pajak = total*0.1;
	  }
	  $('.tax').val(pajak);
	}else{
	  $('.taxpers').val("0");
	  $('.tax').val(pajak);
	}
	grandtotal = total-diskon+pajak;
    $('.grandtotal').val(grandtotal);
  }

  function gridSum() {
	var sum=0;
	var qty;
	var harga;
	var diskon, _diskon;
	var pajak, _pajak;
	var thisRow = this.closest('tr');
    
	var total=0;
	var grandtotal=0;
    $(thisRow).find("td:not(.valjumlah) .valqty").each(function() {
	  if (!isNaN(this.value) && this.value.length != 0) {
		qty = parseFloat(this.value);                     
      }else{
	    qty = 0;
	  }
    }); 
    $(thisRow).find("td:not(.valjumlah) .valharga").each(function() {
	  if (!isNaN(this.value) && this.value.length != 0) {
		harga = parseFloat(this.value);
	  }else{
	    harga = 0;
	  }
    }); 
  	sum=qty*harga;
	$(thisRow).find(".valjumlah").val(sum);
     // total
    $('.valjumlah').each(function() {
         total += parseFloat($(this).val());
    });
    $('.result').val(total);
	_diskon = $('.disc').val();
    if (!isNaN(_diskon) && _diskon.length != 0) {
	 diskon = parseFloat(_diskon);
    }else{
	  diskon = 0;
    }
	_pajak = $('.tax').val();
    if (!isNaN(_pajak) && _pajak.length != 0) {
	  pajak = parseFloat(_pajak);
    }else{
	  _pajak = 0;
    }
	grandtotal = total-diskon+pajak;
    $('.grandtotal').val(grandtotal);
  }

  