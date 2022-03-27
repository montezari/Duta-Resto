function ConfirmDelete(val){
  if(confirm('Are you sure you want to delete this data?')){
     $('#fkey').val(val); 
	 $("form[name='grid']").submit();
  }  
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
            cmbgroup: {
                message: 'Inputan tidak valid',
                validators: {
                    notEmpty: {
                        message: 'Inputan ini harus di pilih'
                    }
                }
            },
            pass: {
                message: 'Inputan tidak valid',
                validators: {
                    notEmpty: {
                        message: 'Inputan ini harus di pilih'
                    }
                }
            },
            user: {
                message: 'Inputan tidak valid',
                validators: {
                    notEmpty: {
                        message: 'Inputan tidak boleh kosong dan harus di isi'
                    },
                    stringLength: {
                        min: 1,
                        max: 150,
                        message: 'Inputan maksimal 150 karakter'
                    },
                    remote: {
                        url: 'validate.php?m=user.user&id='+$('#fkey').val(),
                        message: 'Inputan sudah ada'
                    }
                }
            }
		}
    });
});

$(document).ready(function() {
    $('#selecctall').click(function(event) {  
        if(this.checked) { 
            $('.checkbox1').each(function() { 
                this.checked = true;              
            });
        }else{
            $('.checkbox1').each(function() { 
                this.checked = false;                       
            });        
        }
    });
});