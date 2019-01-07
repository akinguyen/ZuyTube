$(function() {
  $(".deleteReply").click(function() {
    $(".loadingComment").show();
    $.post(
      "deleteReply.php",
      {
        commentId: $(this)
          .next()
          .find("input")
          .val()
      },
      data => {
        var totalComments = parseInt(
          $(".totalComments")
            .text()
            .substring(
              0,
              $(".totalComments")
                .text()
                .indexOf("Comment")
            )
            .trim()
        );

        var res =
          totalComments === 1 || totalComments === 2
            ? totalComments - 1 + " Comment"
            : totalComments - 1 + " Comments";
        $(".totalComments").text(res);
        $(".loadingComment").hide();
      }
    );
    $(this)
      .next()
      .remove();
    $(this).remove();
  });
  $(".likeComment").click(function() {
    if ($(".unameValue").val() !== "") {
      $.post(
        "commentLikeProcessing.php",
        {
          like: 1,
          commentId: $(this)
            .next()
            .val(),
          username: $(".unameValue").val()
        },
        data => {
          console.log(data);
          var res = JSON.parse(data);

          if (res.like === "1") {
            $(this)
              .children("div.fas")
              .removeClass("text-secondary")
              .addClass("text-success");
          } else {
            $(this)
              .children("div.fas")
              .removeClass("text-success")
              .addClass("text-secondary");
          }
          $(this)
            .children("div.likeCommentNumber")
            .text(res.likeTotal);

          if (res.dislike === "1") {
            $(this)
              .next()
              .next()
              .children("div.fas")
              .removeClass("text-secondary")
              .addClass("text-danger");
          } else {
            $(this)
              .next()
              .next()
              .children("div.fas")
              .removeClass("text-danger")
              .addClass("text-secondary");
          }
          $(this)
            .next()
            .next()
            .children("div.dislikeCommentNumber")
            .text(res.dislikeTotal);
        }
      );
    } else {
      $("#signUpForm").css("display", "none");
      $("#loginForm").css("display", "block");
      $("#loginForm").css("width", "auto");
    }
  });
  $(".dislikeComment").click(function() {
    if ($(".unameValue").val() !== "") {
      $.post(
        "commentLikeProcessing.php",
        {
          dislike: 1,
          commentId: $(this)
            .prev()
            .val(),
          username: $(".unameValue").val()
        },
        data => {
          var res = JSON.parse(data);
          if (res.dislike === "1") {
            $(this)
              .children("div.fas")
              .removeClass("text-secondary")
              .addClass("text-danger");
          } else {
            $(this)
              .children("div.fas")
              .removeClass("text-danger")
              .addClass("text-secondary");
          }
          $(this)
            .children("div.dislikeCommentNumber")
            .text(res.dislikeTotal);

          if (res.like === "1") {
            $(this)
              .prev()
              .prev()
              .children("div.fas")
              .removeClass("text-secondary")
              .addClass("text-success");
          } else {
            $(this)
              .prev()
              .prev()
              .children("div.fas")
              .removeClass("text-success")
              .addClass("text-secondary");
          }
          $(this)
            .prev()
            .prev()
            .children("div.likeCommentNumber")
            .text(res.likeTotal);
        }
      );
    } else {
      $("#signUpForm").css("display", "none");
      $("#loginForm").css("display", "block");
      $("#loginForm").css("width", "auto");
    }
  });
  $(".postComment").click(function() {
    if ($(".unameValue").val() !== "") {
      $(".loadingComment").show();
      $.post(
        "postCommentProcessing.php",
        {
          commentInput: $(".commentInput").val(),
          username: $(".unameValue").val(),
          videoId: $(".videoIdValue").val()
        },
        data => {
          window.location.href = "";
        }
      );
    } else {
      $("#signUpForm").css("display", "none");
      $("#loginForm").css("display", "block");
      $("#loginForm").css("width", "auto");
    }
  });
});
