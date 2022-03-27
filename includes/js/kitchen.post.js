$(document).ready(function(){

 function getDoc(frame) {
     var doc = null;
     try {
         if (frame.contentWindow) {
             doc = frame.contentWindow.document;
         }
     } catch(err) {
     }

     if (doc) { 
         return doc;
     }

     try { 
         doc = frame.contentDocument ? frame.contentDocument : frame.document;
     } catch(err) {
         doc = frame.document;
     }
     return doc;
 }

 $("#multiform").submit(function(e){
	$("#multi-msg").html("<div class='progress progress-striped active'><div class='progress-bar'  role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'><span class='sr-only'>100% Complete</span></div>");
	var formObj = $(this);
	var formURL = formObj.attr("action");

    if(window.FormData !== undefined){
		var formData = new FormData(this);
		$.ajax({
        	url: formURL,
	        type: 'POST',
			data:  formData,
			mimeType:"multipart/form-data",
			contentType: false,
    	    cache: false,
        	processData:false,
			success: function(data, textStatus, jqXHR){
			   checknewcook("update");
			   updateprogcook("update");
			   $("#multi-msg").html('<pre><code>'+data+'</code></pre>');
		    },
		  	error: function(jqXHR, textStatus, errorThrown){
			  $("#multi-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
	    	} 	        
	   });
        e.preventDefault();
        e.unbind();
    }else {
		var  iframeId = 'unique' + (new Date().getTime());
		var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');
		iframe.hide();
		formObj.attr('target',iframeId);
		iframe.appendTo('body');
		iframe.load(function(e){
			var doc = getDoc(iframe[0]);
			var docRoot = doc.body ? doc.body : doc.documentElement;
			var data = docRoot.innerHTML;
			$("#multi-msg").html('<pre><code>'+data+'</code></pre>');
		});
	}

 });
 
 $("#multi-post").click(function(){
	$("#multiform").submit();
 });

});