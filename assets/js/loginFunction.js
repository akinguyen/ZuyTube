$(function() {
  $("#signUpForm label[for='fname']").css("display", "none");
  $("#signUpForm label[for='lname']").css("display", "none");
  $("#signUpForm label[for='uname']").css("display", "none");
  $("#signUpForm label[for='email']").css("display", "none");
  $("#signUpForm label[for='pwd']").css("display", "none");

  $(".loginLink").click(() => {
    $("#signUpForm").css("display", "none");
    $("#loginForm").css("display", "block");
    $("#loginForm").css("width", "auto");
  });
  $("#signupLink").click(() => {
    $("#loginForm").css("display", "none");
    $("#signUpForm").css("display", "block");
    $("#signUpForm").css("width", "auto");
  });
  $("#signUpForm button.userFormButton").click(() => {
    $.post(
      window.location.href.includes("index.php") > 0
        ? "assets/pages/signup.php"
        : "../pages/signup.php",
      {
        fname: $("#signUpForm input[name='fname']").val(),
        lname: $("#signUpForm input[name='lname']").val(),
        uname: $("#signUpForm input[name='uname']").val(),
        email: $("#signUpForm input[name='email']").val(),
        pwd: $("#signUpForm input[name='pwd']").val()
      },
      data => {
        //console.log(data);
        if (data) {
          var error = JSON.parse(data);
          if (!(Object.keys(error).length === 0)) {
            $("#signUpForm label[for='fname']")
              .css("display", error.fname ? "block" : "none")
              .text(error.fname);
            $("#signUpForm label[for='lname']")
              .css("display", error.lname ? "block" : "none")
              .text(error.lname);
            $("#signUpForm label[for='uname']")
              .css("display", error.uname ? "block" : "none")
              .text(error.uname);
            $("#signUpForm label[for='email']")
              .css("display", error.email ? "block" : "none")
              .text(error.email);
            $("#signUpForm label[for='pwd']")
              .css("display", error.pwd ? "block" : "none")
              .text(error.pwd);
          } else {
            $("#signUpForm form").submit();
          }
        }
      }
    );
    return false;
  });
  $("#loginForm button.userFormButton").click(() => {
    $.post(
      window.location.href.includes("index.php") > 0
        ? "assets/pages/login.php"
        : "../pages/login.php",
      {
        email: $("#loginForm input[name='email']").val(),
        pwd: $("#loginForm input[name='pwd']").val()
      },
      data => {
        //console.log(data);
        if (data) {
          var error = JSON.parse(data);
          if (!(Object.keys(error).length === 0)) {
            $("#loginForm label[for='email']")
              .css("display", error.email ? "block" : "none")
              .text(error.email);
            $("#loginForm label[for='pwd']")
              .css("display", error.pwd ? "block" : "none")
              .text(error.pwd);
          } else {
            $("#loginForm form").submit();
          }
        }
      }
    );
    return false;
  });
});
