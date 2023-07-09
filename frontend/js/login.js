var UserService = {
  init: function () {
    var token = localStorage.getItem("user_token");
    if (token) {
      window.location.replace("frontend/index.html");
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
      url: "rest/loginUser",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function (result) {
        console.log(result.token);
        localStorage.setItem("token", result.token);
        window.location.replace("frontend/index.html");
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
      },
    });
  },

  logout: function () {
    localStorage.clear();
    window.location.replace("../login.html");
  },
};