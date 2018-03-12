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

/* WEBPACK VAR INJECTION */(function(global) {__webpack_require__(/*! ../css/global.scss */ "./assets/css/global.scss");

// main.js

var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

//only for dev

global.$ = global.jQuery = $;

// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
__webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");
__webpack_require__(/*! select2 */ "./node_modules/select2/dist/js/select2.js");
// or you can include specific pieces
// require('bootstrap-sass/javascripts/bootstrap/tooltip');
// require('bootstrap-sass/javascripts/bootstrap/popover');

function checkPassword() {
  var p1 = $('#form_passPhrase');
  var p2 = $('#form_repeatedPassPhrase');

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

  $('#form_passPhrase').keyup(checkPassword);
  $('#form_repeatedPassPhrase').keyup(checkPassword);

  $(document).on('click', '.cacert-add-lang', function () {
    var root = $('#account_settings_languages');
    var items = $('div[id^="account_settings_languages_"]').length;
    root.append($(root.data('prototype').replace(/__name__/g, items)));
  });

  $(document).on('click', '.cacert-remove-button', function () {
    $('#' + $(this).attr('id').replace(/_remove/g, '')).parent().remove();
  });
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(/*! ./../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ })

},["./assets/js/global.js"]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2dsb2JhbC5zY3NzP2JjYmUiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2dsb2JhbC5qcyJdLCJuYW1lcyI6WyJyZXF1aXJlIiwiJCIsImdsb2JhbCIsImpRdWVyeSIsImNoZWNrUGFzc3dvcmQiLCJwMSIsInAyIiwidmFsIiwicmVtb3ZlQ2xhc3MiLCJhZGRDbGFzcyIsImRvY3VtZW50IiwicmVhZHkiLCJwb3BvdmVyIiwic2VsZWN0MiIsImtleXVwIiwib24iLCJyb290IiwiaXRlbXMiLCJsZW5ndGgiLCJhcHBlbmQiLCJkYXRhIiwicmVwbGFjZSIsImF0dHIiLCJwYXJlbnQiLCJyZW1vdmUiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7QUFBQSx5Qzs7Ozs7Ozs7Ozs7OzhDQ0FBLG1CQUFBQSxDQUFRLG9EQUFSOztBQUVBOztBQUVBLElBQUlDLElBQUksbUJBQUFELENBQVEsb0RBQVIsQ0FBUjs7QUFFQTs7QUFFQUUsT0FBT0QsQ0FBUCxHQUFXQyxPQUFPQyxNQUFQLEdBQWdCRixDQUEzQjs7QUFFQTtBQUNBO0FBQ0EsbUJBQUFELENBQVEsZ0VBQVI7QUFDQSxtQkFBQUEsQ0FBUSwwREFBUjtBQUNBO0FBQ0E7QUFDQTs7QUFFQSxTQUFTSSxhQUFULEdBQ0E7QUFDRSxNQUFJQyxLQUFLSixFQUFFLGtCQUFGLENBQVQ7QUFDQSxNQUFJSyxLQUFLTCxFQUFFLDBCQUFGLENBQVQ7O0FBRUEsTUFBSUssR0FBR0MsR0FBSCxNQUFZRixHQUFHRSxHQUFILEVBQWhCLEVBQ0E7QUFDRUYsT0FBR0csV0FBSCxDQUFlLHFCQUFmLEVBQXNDQyxRQUF0QyxDQUErQyxZQUEvQztBQUNBSCxPQUFHRSxXQUFILENBQWUscUJBQWYsRUFBc0NDLFFBQXRDLENBQStDLFlBQS9DOztBQUVGO0FBQ0M7QUFFQSxHQVJELE1BUUs7QUFDSEosT0FBR0csV0FBSCxDQUFlLHFCQUFmLEVBQXNDQyxRQUF0QyxDQUErQyxVQUEvQztBQUNBSCxPQUFHRSxXQUFILENBQWUscUJBQWYsRUFBc0NDLFFBQXRDLENBQStDLFVBQS9DO0FBQ0Q7QUFDRjs7QUFTRFIsRUFBRVMsUUFBRixFQUFZQyxLQUFaLENBQWtCLFlBQVc7QUFDekJWLElBQUUseUJBQUYsRUFBNkJXLE9BQTdCO0FBQ0FYLElBQUUsUUFBRixFQUFZWSxPQUFaOztBQUVBWixJQUFFLGtCQUFGLEVBQXNCYSxLQUF0QixDQUE0QlYsYUFBNUI7QUFDQUgsSUFBRSwwQkFBRixFQUE4QmEsS0FBOUIsQ0FBb0NWLGFBQXBDOztBQUVBSCxJQUFFUyxRQUFGLEVBQVlLLEVBQVosQ0FBZSxPQUFmLEVBQXdCLGtCQUF4QixFQUE0QyxZQUFVO0FBQ3BELFFBQUlDLE9BQU9mLEVBQUUsNkJBQUYsQ0FBWDtBQUNBLFFBQUlnQixRQUFRaEIsRUFBRSx3Q0FBRixFQUE0Q2lCLE1BQXhEO0FBQ0FGLFNBQUtHLE1BQUwsQ0FBYWxCLEVBQUVlLEtBQUtJLElBQUwsQ0FBVSxXQUFWLEVBQXVCQyxPQUF2QixDQUErQixXQUEvQixFQUE0Q0osS0FBNUMsQ0FBRixDQUFiO0FBQ0QsR0FKRDs7QUFNQWhCLElBQUVTLFFBQUYsRUFBWUssRUFBWixDQUFlLE9BQWYsRUFBd0IsdUJBQXhCLEVBQWlELFlBQVU7QUFDekRkLE1BQUUsTUFBTUEsRUFBRSxJQUFGLEVBQVFxQixJQUFSLENBQWEsSUFBYixFQUFtQkQsT0FBbkIsQ0FBMkIsVUFBM0IsRUFBdUMsRUFBdkMsQ0FBUixFQUFvREUsTUFBcEQsR0FBNkRDLE1BQTdEO0FBQ0QsR0FGRDtBQUlILENBakJELEUiLCJmaWxlIjoiZ2xvYmFsLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW5cblxuXG4vLy8vLy8vLy8vLy8vLy8vLy9cbi8vIFdFQlBBQ0sgRk9PVEVSXG4vLyAuL2Fzc2V0cy9jc3MvZ2xvYmFsLnNjc3Ncbi8vIG1vZHVsZSBpZCA9IC4vYXNzZXRzL2Nzcy9nbG9iYWwuc2Nzc1xuLy8gbW9kdWxlIGNodW5rcyA9IDEiLCJyZXF1aXJlKCcuLi9jc3MvZ2xvYmFsLnNjc3MnKTtcblxuLy8gbWFpbi5qc1xuXG52YXIgJCA9IHJlcXVpcmUoJ2pxdWVyeScpO1xuXG4vL29ubHkgZm9yIGRldlxuXG5nbG9iYWwuJCA9IGdsb2JhbC5qUXVlcnkgPSAkO1xuXG4vLyBKUyBpcyBlcXVpdmFsZW50IHRvIHRoZSBub3JtYWwgXCJib290c3RyYXBcIiBwYWNrYWdlXG4vLyBubyBuZWVkIHRvIHNldCB0aGlzIHRvIGEgdmFyaWFibGUsIGp1c3QgcmVxdWlyZSBpdFxucmVxdWlyZSgnYm9vdHN0cmFwJyk7XG5yZXF1aXJlKCdzZWxlY3QyJyk7XG4vLyBvciB5b3UgY2FuIGluY2x1ZGUgc3BlY2lmaWMgcGllY2VzXG4vLyByZXF1aXJlKCdib290c3RyYXAtc2Fzcy9qYXZhc2NyaXB0cy9ib290c3RyYXAvdG9vbHRpcCcpO1xuLy8gcmVxdWlyZSgnYm9vdHN0cmFwLXNhc3MvamF2YXNjcmlwdHMvYm9vdHN0cmFwL3BvcG92ZXInKTtcblxuZnVuY3Rpb24gY2hlY2tQYXNzd29yZCgpXG57XG4gIHZhciBwMSA9ICQoJyNmb3JtX3Bhc3NQaHJhc2UnKTtcbiAgdmFyIHAyID0gJCgnI2Zvcm1fcmVwZWF0ZWRQYXNzUGhyYXNlJyk7XG5cbiAgaWYoIHAyLnZhbCgpICE9IHAxLnZhbCgpKVxuICB7XG4gICAgcDEucmVtb3ZlQ2xhc3MoJ2lzLWludmFsaWQgaXMtdmFsaWQnKS5hZGRDbGFzcygnaXMtaW52YWxpZCcpO1xuICAgIHAyLnJlbW92ZUNsYXNzKCdpcy1pbnZhbGlkIGlzLXZhbGlkJykuYWRkQ2xhc3MoJ2lzLWludmFsaWQnKTtcblxuICAvLyAgJHAxLmNsb3Nlc3QoJy5mb3JtLWdyb3VwJykuYWRkQ2xhc3MoJ3dhcy12YWxpZGF0ZWQnKTtcbiAgIC8vICRwMi5jbG9zZXN0KCcuZm9ybS1ncm91cCcpLmFkZENsYXNzKCd3YXMtdmFsaWRhdGVkJyk7XG4gICAgXG4gIH1lbHNle1xuICAgIHAxLnJlbW92ZUNsYXNzKCdpcy1pbnZhbGlkIGlzLXZhbGlkJykuYWRkQ2xhc3MoJ2lzLXZhbGlkJyk7XG4gICAgcDIucmVtb3ZlQ2xhc3MoJ2lzLWludmFsaWQgaXMtdmFsaWQnKS5hZGRDbGFzcygnaXMtdmFsaWQnKTtcbiAgfVxufVxuXG5cblxuXG5cblxuXG5cbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xuICAgICQoJ1tkYXRhLXRvZ2dsZT1cInBvcG92ZXJcIl0nKS5wb3BvdmVyKCk7XG4gICAgJCgnc2VsZWN0Jykuc2VsZWN0MigpO1xuXG4gICAgJCgnI2Zvcm1fcGFzc1BocmFzZScpLmtleXVwKGNoZWNrUGFzc3dvcmQpO1xuICAgICQoJyNmb3JtX3JlcGVhdGVkUGFzc1BocmFzZScpLmtleXVwKGNoZWNrUGFzc3dvcmQpO1xuICAgIFxuICAgICQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcuY2FjZXJ0LWFkZC1sYW5nJywgZnVuY3Rpb24oKXtcbiAgICAgIHZhciByb290ID0gJCgnI2FjY291bnRfc2V0dGluZ3NfbGFuZ3VhZ2VzJyk7XG4gICAgICB2YXIgaXRlbXMgPSAkKCdkaXZbaWRePVwiYWNjb3VudF9zZXR0aW5nc19sYW5ndWFnZXNfXCJdJykubGVuZ3RoO1xuICAgICAgcm9vdC5hcHBlbmQoICQocm9vdC5kYXRhKCdwcm90b3R5cGUnKS5yZXBsYWNlKC9fX25hbWVfXy9nLCBpdGVtcykpKTtcbiAgICB9KTtcblxuICAgICQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcuY2FjZXJ0LXJlbW92ZS1idXR0b24nLCBmdW5jdGlvbigpe1xuICAgICAgJCgnIycgKyAkKHRoaXMpLmF0dHIoJ2lkJykucmVwbGFjZSgvX3JlbW92ZS9nLCAnJykpLnBhcmVudCgpLnJlbW92ZSgpO1xuICAgIH0pO1xuICAgIFxufSk7XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9hc3NldHMvanMvZ2xvYmFsLmpzIl0sInNvdXJjZVJvb3QiOiIifQ==