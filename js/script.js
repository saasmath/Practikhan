

(function ($){

  $(document).ready(function() {

    //$('#myTab a:last').tab('show');
    var textArea = document.getElementById('builderHints');
    var myCodeMirror = CodeMirror.fromTextArea(textArea, {
      lineNumbers: true
    });

    textArea = document.getElementById('builderVars');
    myCodeMirror = CodeMirror.fromTextArea(textArea, {
      lineNumbers: true
    });

    // textArea = document.getElementById('builderSolution');
    // myCodeMirror = CodeMirror.fromTextArea(textArea, {
    //   lineNumbers: true
    // });

    textArea = document.getElementById('builderChoices');
    myCodeMirror = CodeMirror.fromTextArea(textArea, {
      lineNumbers: true
    });


    // wire registration form -------------------------------------------------
    $('#registerForm').on('submit', function() {
      var params = {
        name: $('#registerName').val(),
        email: $('#registerEmail').val(),
        password: $('#registerPassword').val(),
        passwordConfirmation: $('#registerPasswordConfirmation').val()
      };
      console.log('registering');
      $('#registerAlert').hide();

      callAjax(website+'index.php/register', params, function(status, data) {
        if (status < -100) {
          $('#registerAlert').text('There was an error').fadeIn(400);
          return false;
        }
        else if (status < 1) {
          $('#registerAlert').text(data.message).fadeIn(400);
          return false;
        }

        window.location.href = website+'index.php/dashboard';
      });

      return false;
    });


    // wire login form -------------------------------------------------
    $('#loginForm').on('submit', function() {
      var params = {
        email: $('#loginEmail').val(),
        password: $('#loginPassword').val()
      };

      console.log('loggin in');
      callAjax(website+'index.php/login', params, function(status, data) {
        if (!status) {
          alert('Account and password do not match');
          return false;
        }
        
        window.location.href = website+'index.php/dashboard';
      });

      return false;
    });




  });



  jQuery.fn.exists = function() {
    return jQuery(this).length > 0;
  };

  Array.prototype.remove = function(from, to) {
    var rest, _ref;
    rest = this.slice((to || from) + 1 || this.length);
    this.length = (_ref = from < 0) != null ? _ref : this.length + {
      from: from
    };
    return this.push.apply(this, rest);
  };

  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, '');
  };

  callAjax = function(url, params, callback) {
    var ajaxOptions = {
      type: 'POST',
      dataType: 'json',
      timeout: 30 * 1000,
      url: url,
      data: params,
      success: function(data) {
        return callback(data.status, data.data);
      },
      error: function(data) {
        callback(-100);
      }
    };
    $.ajax(ajaxOptions);
  };

})(jQuery);

