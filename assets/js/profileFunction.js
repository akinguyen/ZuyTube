$(function() {
  if ($(".isSubValue").val() === "0") {
    $(".subscribe")
      .children()
      .removeClass("btn-danger")
      .addClass("btn-secondary");
  } else {
    $(".subscribe")
      .children()
      .removeClass("btn-secondary")
      .addClass("btn-danger");
  }

  $(".subscribe").click(() => {
    if ($(".unameValue").val() !== "") {
      $.post(
        "subscribe.php",
        { fromUser: $(".unameValue").val(), toUser: $(".toUser").val() },
        data => {
          var res = JSON.parse(data);
          $(".subscribe")
            .children()
            .text(res.total);
          if (res.sub === "0") {
            $(".subscribe")
              .children()
              .removeClass("btn-danger")
              .addClass("btn-secondary");
          } else {
            $(".subscribe")
              .children()
              .removeClass("btn-secondary")
              .addClass("btn-danger");
          }
        }
      );
    }
  });
});
