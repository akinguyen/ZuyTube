$(function() {
  $("#signUpForm label[for='fname']").css("display", "none");
  $("#signUpForm label[for='lname']").css("display", "none");
  $("#signUpForm label[for='uname']").css("display", "none");
  $("#signUpForm label[for='email']").css("display", "none");
  $("#signUpForm label[for='pwd']").css("display", "none");

  $("#signUpForm button.userFormButtonForProfile").click(() => {
    $.post(
      "editUser.php",
      {
        currentEmail: $(".currentEmail").val(),
        currentUser: $(".unameValue").val(),
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
});
