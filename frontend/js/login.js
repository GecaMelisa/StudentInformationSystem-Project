/*var UserService = {
      init: function () {
        var token = localStorage.getItem("user_token");
        if (token) {
          window.location.replace("dashboard.html");
        }
        $("#login-form").validate({
          submitHandler: function (form) {
            var entity = Object.fromEntries(new FormData(form).entries());
            UserService.login(entity);
          },
        });
      },
      login: function (entity) {
        $.ajax({
          url: "rest/login",
          type: "POST",
          data: JSON.stringify(entity),
          contentType: "application/json",
          dataType: "json",
          success: function (result) {
            console.log(result);
            localStorage.setItem("user_token", result.token);
            window.location.replace("dashboard.html");
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);
          },
        });
      },
    
      logout: function () {
        localStorage.clear();
        window.location.replace("login.html");
      },
    };
    */
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Spriječi podnošenje obrasca
    
        // Dohvati unesene vrijednosti
        var email = document.getElementById('inputEmail').value;
        var password = document.getElementById('inputPassword').value;
    
        // Provjeri da li su polja ispunjena
        if (email.trim() === '' || password.trim() === '') {
            alert('ERROR MESSAGE: All fields are required');
            return;
        }
    
        // Provjeri unesene podatke
        if (email === 'melisa.geca@stu.ibu.edu.ba' && password === '123456') {
            window.location.href = 'dashboard.html'; // Preusmjeri na dashboard.html
        } else {
            alert('ERROR MESSAGE: Invalid email or password');
        }
    });
    

