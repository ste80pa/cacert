require('../css/global.scss');

// main.js

var $ = require('jquery');

//only for dev

global.$ = global.jQuery = $;

// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap');
require('select2');
// or you can include specific pieces
// require('bootstrap-sass/javascripts/bootstrap/tooltip');
// require('bootstrap-sass/javascripts/bootstrap/popover');

function checkPassword()
{
  var p1 = $('#form_passPhrase');
  var p2 = $('#form_repeatedPassPhrase');

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

    $('#form_passPhrase').keyup(checkPassword);
    $('#form_repeatedPassPhrase').keyup(checkPassword);
    
    $(document).on('click', '.cacert-add-lang', function(){
      var root = $('#account_settings_languages');
      var items = $('div[id^="account_settings_languages_"]').length;
      root.append( $(root.data('prototype').replace(/__name__/g, items)));
    });

    $(document).on('click', '.cacert-remove-button', function(){
      $('#' + $(this).attr('id').replace(/_remove/g, '')).parent().remove();
    });
    
});
