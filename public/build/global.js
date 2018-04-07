webpackJsonp([1],{

/***/ "./assets/css/global.scss":
/*!********************************!*\
  !*** ./assets/css/global.scss ***!
  \********************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./assets/js/global.js":
/*!*****************************!*\
  !*** ./assets/js/global.js ***!
  \*****************************/
/*! dynamic exports provided */
/*! all exports used */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(__webpack_provided_window_dot_jQuery, global, $) {__webpack_require__(/*! ../css/global.scss */ "./assets/css/global.scss");

// main.js


//only for dev

global.$ = global.jQuery = window.$ = __webpack_provided_window_dot_jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
__webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");
__webpack_require__(/*! select2 */ "./node_modules/select2/dist/js/select2.js");
//require( 'datatables.net-bs' );


// or you can include specific pieces
// require('bootstrap-sass/javascripts/bootstrap/tooltip');
// require('bootstrap-sass/javascripts/bootstrap/popover');

function checkPassword() {
    var p1 = $('#account_settings_plainPassword_first');
    var p2 = $('#account_settings_plainPassword_second');

    if (p2.val() != p1.val()) {
        p1.removeClass('is-invalid is-valid').addClass('is-invalid');
        p2.removeClass('is-invalid is-valid').addClass('is-invalid');

        //  $p1.closest('.form-group').addClass('was-validated');
        // $p2.closest('.form-group').addClass('was-validated');
    } else {
        p1.removeClass('is-invalid is-valid').addClass('is-valid');
        p2.removeClass('is-invalid is-valid').addClass('is-valid');
    }
}

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    $('select').select2();

    $('#account_settings_plainPassword_first').keyup(checkPassword);
    $('#account_settings_plainPassword_second').keyup(checkPassword);

    $('body').on('click', '.cacert-add-button', function () {

        var e = console.log($(this).data('target'));
        var root = $(this).parents('.collection-container');
        var items = root.data('count');
        var elem = root.data('prototype').replace(/__name__/g, items);
        root.data('count', items + 1);
        root.append(elem);
        /*var items = $('div[id^="_entry"]').length;
            	
        $($(this).data('target')).insertAfter();
         
        
         root.append( ));*/
    });

    $('body').on('click', '.cacert-remove-button', function () {
        var root = $(this).parents('.collection-container');
        var items = root.data('count');
        root.data('count', items - 1);
        $($(this).data('target')).remove();
    });

    $('body').on('submit', '.cacert-ajax-form', function (e) {
        e.preventDefault();

        var form = $(this);
        var buttons = $(this).find('[type="submit"]');

        buttons.prop('disabled', true);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize()
            //headers: {'X-Requested-With': 'XMLHttpRequest'}

        }).done(function (data) {

            form.find('.invalid-feedback').remove();
            form.find('.is-invalid').removeClass('is-invalid');
            form.find('.is-valid').removeClass('is-valid');

            if (typeof data.message !== 'undefined') {
                //alert(data.message);

                if (typeof data.errors !== 'undefined') {
                    var errors = data.errors;
                    var l = errors.length;
                    var elem = null;
                    var error;
                    for (var i = 0; i < l; i++) {
                        error = errors[i];
                        elem = $('#' + error.path);
                        elem.removeClass('is-valid').addClass('is-invalid');
                        $('<div class="invalid-feedback">' + error.error + '</div>').insertAfter(elem);
                    }
                }
                console.log(data);
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('form')) {
                    //   $('#form_body').html(jqXHR.responseJSON.form);
                }
                alert(jqXHR.responseJSON.message);
                //$('.form_error').html(jqXHR.responseJSON.message);
            } else {
                alert(errorThrown);
            }
        }).always(function () {
            buttons.prop('disabled', false);
        });
    });

    $('table').DataTable();
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js"), __webpack_require__(/*! ./../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js"), __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ })

},["./assets/js/global.js"]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2dsb2JhbC5zY3NzP2JjYmUiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2dsb2JhbC5qcyJdLCJuYW1lcyI6WyJyZXF1aXJlIiwiZ2xvYmFsIiwiJCIsImpRdWVyeSIsIndpbmRvdyIsImNoZWNrUGFzc3dvcmQiLCJwMSIsInAyIiwidmFsIiwicmVtb3ZlQ2xhc3MiLCJhZGRDbGFzcyIsImRvY3VtZW50IiwicmVhZHkiLCJwb3BvdmVyIiwic2VsZWN0MiIsImtleXVwIiwib24iLCJlIiwiY29uc29sZSIsImxvZyIsImRhdGEiLCJyb290IiwicGFyZW50cyIsIml0ZW1zIiwiZWxlbSIsInJlcGxhY2UiLCJhcHBlbmQiLCJyZW1vdmUiLCJwcmV2ZW50RGVmYXVsdCIsImZvcm0iLCJidXR0b25zIiwiZmluZCIsInByb3AiLCJhamF4IiwidHlwZSIsImF0dHIiLCJ1cmwiLCJzZXJpYWxpemUiLCJkb25lIiwibWVzc2FnZSIsImVycm9ycyIsImwiLCJsZW5ndGgiLCJlcnJvciIsImkiLCJwYXRoIiwiaW5zZXJ0QWZ0ZXIiLCJmYWlsIiwianFYSFIiLCJ0ZXh0U3RhdHVzIiwiZXJyb3JUaHJvd24iLCJyZXNwb25zZUpTT04iLCJoYXNPd25Qcm9wZXJ0eSIsImFsZXJ0IiwiYWx3YXlzIiwiRGF0YVRhYmxlIl0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7O0FBQUEseUM7Ozs7Ozs7Ozs7Ozt1RkNBQSxtQkFBQUEsQ0FBUSxvREFBUjs7QUFJQTs7O0FBR0E7O0FBRUFDLE9BQU9DLENBQVAsR0FBV0QsT0FBT0UsTUFBUCxHQUFnQkMsT0FBT0YsQ0FBUCxHQUFXLHVDQUFnQixtQkFBQUYsQ0FBUSxvREFBUixDQUF0RDs7QUFFQTtBQUNBO0FBQ0EsbUJBQUFBLENBQVEsZ0VBQVI7QUFDQSxtQkFBQUEsQ0FBUSwwREFBUjtBQUNBOzs7QUFLQTtBQUNBO0FBQ0E7O0FBRUEsU0FBU0ssYUFBVCxHQUNBO0FBQ0UsUUFBSUMsS0FBS0osRUFB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QUVILENBNUZELEUiLCJmaWxlIjoiZ2xvYmFsLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW5cblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyAuL2Fzc2V0cy9jc3MvZ2xvYmFsLnNjc3Ncbi8vIG1vZHVsZSBpZCA9IC4vYXNzZXRzL2Nzcy9nbG9iYWwuc2Nzc1xuLy8gbW9kdWxlIGNodW5rcyA9IDEiLCJyZXF1aXJlKCcuLi9jc3MvZ2xvYmFsLnNjc3MnKTtcblxuXG5cbi8vIG1haW4uanNcblxuXG4vL29ubHkgZm9yIGRldlxuXG5nbG9iYWwuJCA9IGdsb2JhbC5qUXVlcnkgPSB3aW5kb3cuJCA9IHdpbmRvdy5qUXVlcnkgPSByZXF1aXJlKCdqcXVlcnknKTtcblxuLy8gSlMgaXMgZXF1aXZhbGVudCB0byB0aGUgbm9ybWFsIFwiYm9vdHN0cmFwXCIgcGFja2FnZVxuLy8gbm8gbmVlZCB0byBzZXQgdGhpcyB0byBhIHZhcmlhYmxlLCBqdXN0IHJlcXVpcmUgaXRcbnJlcXVpcmUoJ2Jvb3RzdHJhcCcpO1xucmVxdWlyZSgnc2VsZWN0MicpO1xuLy9yZXF1aXJlKCAnZGF0YXRhYmxlcy5uZXQtYnMnICk7XG5cblxuXG5cbi8vIG9yIHlvdSBjYW4gaW5jbHVkZSBzcGVjaWZpYyBwaWVjZXNcbi8vIHJlcXVpcmUoJ2Jvb3RzdHJhcC1zYXNzL2phdmFzY3JpcHRzL2Jvb3RzdHJhcC90b29sdGlwJyk7XG4vLyByZXF1aXJlKCdib290c3RyYXAtc2Fzcy9qYXZhc2NyaXB0cy9ib290c3RyYXAvcG9wb3ZlcicpO1xuXG5mdW5jdGlvbiBjaGVja1Bhc3N3b3JkKClcbntcbiAgdmFyIHAxID0gJCgnI2FjY291bnRfc2V0dGluZ3NfcGxhaW5QYXNzd29yZF9maXJzdCcpO1xuICB2YXIgcDIgPSAkKCcjYWNjb3VudF9zZXR0aW5nc19wbGFpblBhc3N3b3JkX3NlY29uZCcpO1xuXG4gIGlmKCBwMi52YWwoKSAhPSBwMS52YWwoKSlcbiAge1xuICAgIHAxLnJlbW92ZUNsYXNzKCdpcy1pbnZhbGlkIGlzLXZhbGlkJykuYWRkQ2xhc3MoJ2lzLWludmFsaWQnKTtcbiAgICBwMi5yZW1vdmVDbGFzcygnaXMtaW52YWxpZCBpcy12YWxpZCcpLmFkZENsYXNzKCdpcy1pbnZhbGlkJyk7XG5cbiAgLy8gICRwMS5jbG9zZXN0KCcuZm9ybS1ncm91cCcpLmFkZENsYXNzKCd3YXMtdmFsaWRhdGVkJyk7XG4gICAvLyAkcDIuY2xvc2VzdCgnLmZvcm0tZ3JvdXAnKS5hZGRDbGFzcygnd2FzLXZhbGlkYXRlZCcpO1xuICAgIFxuICB9ZWxzZXtcbiAgICBwMS5yZW1vdmVDbGFzcygnaXMtaW52YWxpZCBpcy12YWxpZCcpLmFkZENsYXNzKCdpcy12YWxpZCcpO1xuICAgIHAyLnJlbW92ZUNsYXNzKCdpcy1pbnZhbGlkIGlzLXZhbGlkJykuYWRkQ2xhc3MoJ2lzLXZhbGlkJyk7XG4gIH1cbn1cblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XG4gICAgJCgnW2RhdGEtdG9nZ2xlPVwicG9wb3ZlclwiXScpLnBvcG92ZXIoKTtcbiAgICAkKCdzZWxlY3QnKS5zZWxlY3QyKCk7XG5cbiAgICAkKCcjYWNjb3VudF9zZXR0aW5nc19wbGFpblBhc3N3b3JkX2ZpcnN0Jykua2V5dXAoY2hlY2tQYXNzd29yZCk7XG4gICAgJCgnI2FjY291bnRfc2V0dGluZ3NfcGxhaW5QYXNzd29yZF9zZWNvbmQnKS5rZXl1cChjaGVja1Bhc3N3b3JkKTtcbiAgICBcbiAgICAkKCdib2R5Jykub24oJ2NsaWNrJywgJy5jYWNlcnQtYWRkLWJ1dHRvbicsIGZ1bmN0aW9uKCl7XG4gICAgXHRcbiAgIHZhciBlID0gY29uc29sZS5sb2coJCh0aGlzKS5kYXRhKCd0YXJnZXQnKSk7XG4gICB2YXIgcm9vdCA9ICQodGhpcykucGFyZW50cygnLmNvbGxlY3Rpb24tY29udGFpbmVyJyk7XG4gICB2YXIgaXRlbXMgPSByb290LmRhdGEoJ2NvdW50Jyk7XG5cdHZhciBlbGVtID0gcm9vdC5kYXRhKCdwcm90b3R5cGUnKS5yZXBsYWNlKC9fX25hbWVfXy9nLCBpdGVtcyk7XG5cdHJvb3QuZGF0YSgnY291bnQnLCBpdGVtcyArMSApO1xuXHRyb290LmFwcGVuZChlbGVtICk7XG4gICAgXHQvKnZhciBpdGVtcyA9ICQoJ2RpdltpZF49XCJfZW50cnlcIl0nKS5sZW5ndGg7XG4gICAgXG4gICAgXHRcbiAgICBcdCQoJCh0aGlzKS5kYXRhKCd0YXJnZXQnKSkuaW5zZXJ0QWZ0ZXIoKTtcbiAgICAgIFxuICAgICBcbiAgICAgIHJvb3QuYXBwZW5kKCApKTsqL1xuICAgIH0pO1xuXG4gICAgJCgnYm9keScpLm9uKCdjbGljaycsICcuY2FjZXJ0LXJlbW92ZS1idXR0b24nLCBmdW5jdGlvbigpe1xuICAgIFx0ICAgdmFyIHJvb3QgPSAkKHRoaXMpLnBhcmVudHMoJy5jb2xsZWN0aW9uLWNvbnRhaW5lcicpO1xuICAgIFx0ICAgdmFyIGl0ZW1zID0gcm9vdC5kYXRhKCdjb3VudCcpO1xuICAgIFx0ICAgcm9vdC5kYXRhKCdjb3VudCcsIGl0ZW1zIC0gMSApO1xuICAgICAgJCgkKHRoaXMpLmRhdGEoJ3RhcmdldCcpKS5yZW1vdmUoKTtcbiAgICB9KTtcbiAgICBcbiAgICAkKCdib2R5Jykub24oJ3N1Ym1pdCcsICcuY2FjZXJ0LWFqYXgtZm9ybScsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgXG4gICAgICAgIFxuICAgICAgICB2YXIgZm9ybSA9ICQodGhpcyk7XG4gICAgICAgIHZhciBidXR0b25zID0gJCh0aGlzKS5maW5kKCdbdHlwZT1cInN1Ym1pdFwiXScpO1xuXG4gICAgICAgIGJ1dHRvbnMucHJvcCgnZGlzYWJsZWQnLHRydWUpO1xuICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgdHlwZTogZm9ybS5hdHRyKCdtZXRob2QnKSxcbiAgICAgICAgICAgIHVybDogZm9ybS5hdHRyKCdhY3Rpb24nKSxcbiAgICAgICAgICAgIGRhdGE6IGZvcm0uc2VyaWFsaXplKCksXG4gICAgICAgICAgICAvL2hlYWRlcnM6IHsnWC1SZXF1ZXN0ZWQtV2l0aCc6ICdYTUxIdHRwUmVxdWVzdCd9XG5cbiAgICAgICAgfSlcbiAgICAgICAgLmRvbmUoZnVuY3Rpb24gKGRhdGEpIHtcbiAgICAgICBcbiAgICAgICAgXHRcdGZvcm0uZmluZCgnLmludmFsaWQtZmVlZGJhY2snKS5yZW1vdmUoKTtcbiAgICAgICAgXHRcdGZvcm0uZmluZCgnLmlzLWludmFsaWQnKS5yZW1vdmVDbGFzcygnaXMtaW52YWxpZCcpO1xuICAgICAgICBcdFx0Zm9ybS5maW5kKCcuaXMtdmFsaWQnKS5yZW1vdmVDbGFzcygnaXMtdmFsaWQnKTtcbiAgICAgICAgXHRcbiAgICAgICAgICAgIGlmICh0eXBlb2YgZGF0YS5tZXNzYWdlICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgICAgIC8vYWxlcnQoZGF0YS5tZXNzYWdlKTtcbiAgICAgICAgICAgIFx0XG4gICAgICAgICAgICBcdGlmKHR5cGVvZiBkYXRhLmVycm9ycyAhPT0gJ3VuZGVmaW5lZCcpe1xuICAgICAgICAgICAgXHRcdHZhciBlcnJvcnMgPSBkYXRhLmVycm9ycztcbiAgICAgICAgICAgIFx0XHR2YXIgbCA9IGVycm9ycy5sZW5ndGg7XG4gICAgICAgICAgICBcdFx0dmFyIGVsZW09IG51bGw7XG4gICAgICAgICAgICBcdFx0dmFyIGVycm9yO1xuICAgICAgICAgICAgXHRcdGZvcih2YXIgaSA9MDsgaTxsOyBpKyspXG4gICAgICAgICAgICBcdFx0e1xuICAgICAgICAgICAgXHRcdFx0ZXJyb3IgPSBlcnJvcnNbaV07XG4gICAgICAgICAgICBcdFx0ZWxlbSA9ICQoJyMnKyBlcnJvci5wYXRoKTtcbiAgICAgICAgICAgIFx0XHRlbGVtLnJlbW92ZUNsYXNzKCdpcy12YWxpZCcpLmFkZENsYXNzKCdpcy1pbnZhbGlkJyk7XG4gICAgICAgICAgICBcdFx0JCgnPGRpdiBjbGFzcz1cImludmFsaWQtZmVlZGJhY2tcIj4nICsgZXJyb3IuZXJyb3IgKyAnPC9kaXY+JykuaW5zZXJ0QWZ0ZXIoZWxlbSk7XG4gICAgICAgICAgICBcdFx0fVxuICAgICAgICAgICAgXHR9XG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coZGF0YSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pXG4gICAgICAgIC5mYWlsKGZ1bmN0aW9uIChqcVhIUiwgdGV4dFN0YXR1cywgZXJyb3JUaHJvd24pIHtcbiAgICAgICAgICAgIGlmICh0eXBlb2YganFYSFIucmVzcG9uc2VKU09OICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgICAgIGlmIChqcVhIUi5yZXNwb25zZUpTT04uaGFzT3duUHJvcGVydHkoJ2Zvcm0nKSkge1xuICAgICAgICAgICAgICAgICAvLyAgICQoJyNmb3JtX2JvZHknKS5odG1sKGpxWEhSLnJlc3BvbnNlSlNPTi5mb3JtKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgYWxlcnQoanFYSFIucmVzcG9uc2VKU09OLm1lc3NhZ2UpO1xuICAgICAgICAgICAgICAgIC8vJCgnLmZvcm1fZXJyb3InKS5odG1sKGpxWEhSLnJlc3BvbnNlSlNPTi5tZXNzYWdlKTtcbiBcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgYWxlcnQoZXJyb3JUaHJvd24pO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgXG4gICAgICAgICAgICBcbiBcbiAgICAgICAgfSkuYWx3YXlzKGZ1bmN0aW9uKCl7XG4gICAgICAgIFx0YnV0dG9ucy5wcm9wKCdkaXNhYmxlZCcsZmFsc2UpO1xuICAgICAgICB9KTtcbiAgICB9KTtcblxuICAgICQoJ3RhYmxlJykuRGF0YVRhYmxlKCk7XG4gICAgXG59KTtcblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL2Fzc2V0cy9qcy9nbG9iYWwuanMiXSwic291cmNlUm9vdCI6IiJ9