/* ========================= NEW ORDER TO KITCHEN ========================= */
function checkneworder(){
	$.ajax({
		type: 'POST',
		url: 'ajax/kitchen.neworder.php',
		dataType: 'json',
		data: {
			counter:$('#neworder-list').data('counter')
		}
	}).done(function( response ) {
		$('#neworder-list').data('counter',response.current);
		if(response.update==true){
			$('#neworder-count').html(response.neworder);
			$('#neworder-list').html(response.listcust);
			//if($('#neworder-detail').data('counter')==""){
			  $('#neworder-detail').html(response.listorder);
			  $('#neworder-info-pesanan').html(response.infopesanan);
			  $('#neworder-fkey').val(response.idpesanan);
			//}
		}
	});
}
//cek 5 detik jika ada update data
//setInterval(checkneworder,5000);

function shownewdetail(id){
	$.ajax({
		type: 'POST',
		url: 'ajax/kitchen.neworderdt.php',
		dataType: 'json',
		data: {
			counter:$('#neworder-detail').data('counter'),
			idpesan:id
		},
		beforeSend: function() { $('#wait').show(); },
        complete: function() { $('#wait').hide(); }
	}).done(function( response ) {
		$('#neworder-detail').data('counter',response.idpesan);
		$('#neworder-detail').html(response.listorder);
		$('#neworder-info-pesanan').html(response.infopesanan);
		$('#neworder-fkey').val(response.idpesanan);
	});
}

function docooking(){
  if(confirm('Are you sure you want process to kitchen?')){
	$.ajax({
		type: 'POST',
		url: 'ajax/kitchen.cook.php',
		dataType: 'json',
		data: {
			idpesan:$('#neworder-fkey').val()
		},
		beforeSend: function() { $('#wait').show(); },
        complete: function() { $('#wait').hide(); }
	}).done(function( response ) {
		if(response.sukses==true){
		  checkneworder();  
		}
	});
  }
}

/* ========================= COOKING IN PROGRESS ========================= */
function checknewcook(flag){
	if(typeof(flag)==='undefined') flag = "";
	$.ajax({
		type: 'POST',
		url: 'ajax/kitchen.newcook.php',
		dataType: 'json',
		data: {
			counter:$('#onprogress-list').data('counter'),
	        sync:flag
		}
	}).done(function( response ) {
		$('#onprogress-list').data('counter',response.current);
		if(response.update==true){
			$('#onprogress-count').html(response.neworder);
			$('#onprogress-list').html(response.listcust);
			$('#onprogress-persen').css("width",response.persen+"%");
			$('#onprogress-persen-info').html(response.persen+"% Complete");
			//if($('#onprogress-detail').data('counter')==""){
			  $('#onprogress-detail').html(response.listorder);
			  $('#onprogress-info-pesanan').html(response.infopesanan);
			  $('#onprogress-fkey').val(response.idpesanan);
			//}
		}
	});
}
//cek 5 detik jika ada update data
setInterval(checknewcook,5000);

function showprogressdetail(id){
	$.ajax({
		type: 'POST',
		url: 'ajax/kitchen.newcookdt.php',
		dataType: 'json',
		data: {
			counter:$('#onprogress-detail').data('counter'),
			idpesan:id
		},
		beforeSend: function() { $('#wait').show(); },
        complete: function() { $('#wait').hide(); }
	}).done(function( response ) {
		$('#onprogress-detail').data('counter',response.idpesan);
		$('#onprogress-detail').html(response.listorder);
		$('#onprogress-info-pesanan').html(response.infopesanan);
		$('#onprogress-fkey').val(response.idpesanan);
	});
}

function updateprogcook(flag){
	if(typeof(flag)==='undefined') flag = "";
	$.ajax({
		type: 'POST',
		url: 'ajax/kitchen.newcook.php',
		dataType: 'json',
		data: {
			counter:$('#onprogress-list').data('counter'),
	        sync:flag
		}
	}).done(function( response ) {
		$('#onprogress-persen').css("width",response.persen+"%");
		$('#onprogress-persen-info').html(response.persen+"% Complete");
	});
}


/* ========================= FINISH ORDER ========================= */
function checkfinish(){
	$.ajax({
		type: 'POST',
		url: 'ajax/kitchen.finish.php',
		dataType: 'json',
		data: {
			counter:$('#finishorder-list').data('counter')
		}
	}).done(function( response ) {
		$('#finishorder-list').data('counter',response.current);
		if(response.update==true){
			$('#finishorder-count').html(response.neworder);
			$('#finishorder-list').html(response.listcust);
			//if($('#finishorder-detail').data('counter')==""){
			  $('#finishorder-detail').html(response.listorder);
			  $('#finishorder-info-pesanan').html(response.infopesanan);
			  $('#finishorder-fkey').val(response.idpesanan);
			//}
		}
	});
}
//cek 5 detik jika ada update data
setInterval(checkfinish,5000);

function showfinishdetail(id){
	$.ajax({
		type: 'POST',
		url: 'ajax/kitchen.finishdt.php',
		dataType: 'json',
		data: {
			counter:$('#finishorder-detail').data('counter'),
			idpesan:id
		},
		beforeSend: function() { $('#wait').show(); },
        complete: function() { $('#wait').hide(); }
	}).done(function( response ) {
		$('#finishorder-detail').data('counter',response.idpesan);
		$('#finishorder-detail').html(response.listorder);
		$('#finishorder-info-pesanan').html(response.infopesanan);
		$('#finishorder-fkey').val(response.idpesanan);
	});
}
