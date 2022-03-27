  $(document).ready(function(){
    $("input:checkbox").each(function() {
		$(this).change(function(){
            setchecked.call(this);
        });
    });
  });

  function validval(param){
	var value;
	param = param.replace(",","");
	if (!isNaN(param) && param.length != 0) {
	  value = parseFloat(param);	
    }else{
	  value = 0;
    }
    return value;    
  }

  function setchecked(){
	var thisRow = this.closest('tr');
	if ($(this).prop('checked')) {
	  $(thisRow).find(".jumlah").val($(this).val());  
	}else{
	  $(thisRow).find(".jumlah").val("0");
	}
  }

  function setPaymentDetail(){
	var tagihan;
	var nilai;
    var sisatagihan = 0;
	var payment = validval($('#payment').val());
    var sisa = payment;
	$("[name^='chk']").each(function() {
	  var thisRow = $(this).closest('tr');
	  sisatagihan = sisa;
	  tagihan = validval($(thisRow).find(".tagihan").val());      
	  sisa -= tagihan;
	  if(sisatagihan<0){
	    tagihan = 0;
	  }else if(sisatagihan<tagihan){
	    tagihan = sisatagihan;
	  }
	  $(thisRow).find(".jumlah").val(tagihan);	    
    });
  }