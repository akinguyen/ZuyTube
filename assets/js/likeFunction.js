$(function() {
  if ($(".unameValue").val() === $(".toUser").val()) {
    $(".subscribe").css("display", "none");
  } else {
    $(".editVideo").css("display", "none");
  }
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
    } else {
      $("#signUpForm").css("display", "none");
      $("#loginForm").css("display", "block");
      $("#loginForm").css("width", "auto");
    }
  });
  if ($(".isLikeValue").val() === "0") {
    $(".like")
      .parent()
      .removeClass("btn-success")
      .addClass("btn-secondary");
  } else {
    $(".like")
      .parent()
      .removeClass("btn-secondary")
      .addClass("btn-success");
  }
  if ($(".isDislikeValue").val() === "0") {
    $(".dislike")
      .parent()
      .removeClass("btn-danger")
      .addClass("btn-secondary");
  } else {
    $(".dislike")
      .parent()
      .removeClass("btn-secondary")
      .addClass("btn-danger");
  }

  $(".like").click(event => {
    if ($(".unameValue").val() !== "") {
      $.post(
        "like.php",
        {
          videoId: $(".videoIdValue").val(),
          username: $(".unameValue").val(),
          like: 1
        },
        data => {
          var res = JSON.parse(data);
          $(".likeNumber").text(res.likeTotal);
          if (!(res.like === "1")) {
            $(".like")
              .parent()
              .removeClass("btn-success")
              .addClass("btn-secondary");
          } else {
            $(".like")
              .parent()
              .removeClass("btn-secondary")
              .addClass("btn-success");
          }
          if (!(res.dislike === "1")) {
            $(".dislike")
              .parent()
              .removeClass("btn-danger")
              .addClass("btn-secondary");
          } else {
            $(".dislike")
              .parent()
              .removeClass("btn-secondary")
              .addClass("btn-danger");
          }
          $(".dislikeNumber").text(res.dislikeTotal);
        }
      );
    } else {
      $("#signUpForm").css("display", "none");
      $("#loginForm").css("display", "block");
      $("#loginForm").css("width", "auto");
    }
  });
  $(".dislike").click(event => {
    if ($(".unameValue").val() !== "") {
      $.post(
        "like.php",
        {
          videoId: $(".videoIdValue").val(),
          username: $(".unameValue").val(),
          dislike: 1
        },
        data => {
          var res = JSON.parse(data);
          $(".likeNumber").text(res.likeTotal);
          if (!(res.like === "1")) {
            $(".like")
              .parent()
              .removeClass("btn-success")
              .addClass("btn-secondary");
          } else {
            $(".like")
              .parent()
              .removeClass("btn-secondary")
              .addClass("btn-success");
          }
          if (!(res.dislike === "1")) {
            $(".dislike")
              .parent()
              .removeClass("btn-danger")
              .addClass("btn-secondary");
          } else {
            $(".dislike")
              .parent()
              .removeClass("btn-secondary")
              .addClass("btn-danger");
          }

          $(".dislikeNumber").text(res.dislikeTotal);
        }
      );
    } else {
      $("#signUpForm").css("display", "none");
      $("#loginForm").css("display", "block");
      $("#loginForm").css("width", "auto");
    }
  });
});
