require('../css/global.scss');



// main.js


//only for dev

global.$ = global.jQuery = window.$ = window.jQuery = require('jquery');

// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap');
require('select2');
//require( 'datatables.net-bs' );




// or you can include specific pieces
// require('bootstrap-sass/javascripts/bootstrap/tooltip');
// require('bootstrap-sass/javascripts/bootstrap/popover');

function checkPassword()
{
  var p1 = $('#account_settings_plainPassword_first');
  var p2 = $('#account_settings_plainPassword_second');

  if( p2.val() != p1.val())
  {
    p1.removeClass('is-invalid is-valid').addClass('is-invalid');
    p2.removeClass('is-invalid is-valid').addClass('is-invalid');

  //  $p1.closest('.form-group').addClass('was-validated');
   // $p2.closest('.form-group').addClass('was-validated');
    
  }else{
    p1.removeClass('is-invalid is-valid').addClass('is-valid');
    p2.removeClass('is-invalid is-valid').addClass('is-valid');
  }
}

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('select').select2();

    $('#account_settings_plainPassword_first').keyup(checkPassword);
    $('#account_settings_plainPassword_second').keyup(checkPassword);
    
    $('body').on('click', '.cacert-add-button', function(){
    	
   var e = console.log($(this).data('target'));
   var root = $(this).parents('.collection-container');
   var items = root.data('count');
	var elem = root.data('prototype').replace(/__name__/g, items);
	root.data('count', items +1 );
	root.append(elem );
    	/*var items = $('div[id^="_entry"]').length;
    
    	
    	$($(this).data('target')).insertAfter();
      
     
      root.append( ));*/
    });

    $('body').on('click', '.cacert-remove-button', function(){
    	   var root = $(this).parents('.collection-container');
    	   var items = root.data('count');
    	   root.data('count', items - 1 );
      $($(this).data('target')).remove();
    });
    
    $('body').on('submit', '.cacert-ajax-form', function (e) {
        e.preventDefault();
        
        
        var form = $(this);
        var buttons = $(this).find('[type="submit"]');

        buttons.prop('disabled',true);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            //headers: {'X-Requested-With': 'XMLHttpRequest'}

        })
        .done(function (data) {
       
        		form.find('.invalid-feedback').remove();
        		form.find('.is-invalid').removeClass('is-invalid');
        		form.find('.is-valid').removeClass('is-valid');
        	
            if (typeof data.message !== 'undefined') {
                //alert(data.message);
            	
            	if(typeof data.errors !== 'undefined'){
            		var errors = data.errors;
            		var l = errors.length;
            		var elem= null;
            		var error;
            		for(var i =0; i<l; i++)
            		{
            			error = errors[i];
            		elem = $('#'+ error.path);
            		elem.removeClass('is-valid').addClass('is-invalid');
            		$('<div class="invalid-feedback">' + error.error + '</div>').insertAfter(elem);
            		}
            	}
                console.log(data);
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('form')) {
                 //   $('#form_body').html(jqXHR.responseJSON.form);
                }
                alert(jqXHR.responseJSON.message);
                //$('.form_error').html(jqXHR.responseJSON.message);
 
            } else {
                alert(errorThrown);
            }
            
            
 
        }).always(function(){
        	buttons.prop('disabled',false);
        });
    });

    $('table').DataTable();
    
});
