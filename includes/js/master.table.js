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
            nama: {
                message: 'Inputan tidak valid',
                validators: {
                    notEmpty: {
                        message: 'Inputan tidak boleh kosong dan harus di isi'
                    },
                    stringLength: {
                        min: 1,
                        max: 10,
                        message: 'Inputan maksimal 10 karakter'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'Inputan tidak valid'
                    },
                    remote: {
                        url: 'validate.php?m=master.table',
                        message: 'Inputan sudah ada'
                    }
                }
            }
		}
    });
});
