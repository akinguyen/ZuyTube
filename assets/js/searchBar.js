$(function() {
  $(".searchButton").click(() => {
    if ($(".searchBar").css("display") === "none") {
      $(".navbar-nav").css("display", "none");
      $(".searchBar").css({ width: "75%", display: "block" });
      $(".searchForm").css({ width: "100%" });
      $(".back-button").css({ display: "block" });
      $(".searchButton").css({ display: "block", "margin-left": "10px" });
    }
    return false;
  });
  $(".back-button").click(() => {
    $(".navbar-nav").css("display", "flex");
    $(".searchBar").css({ display: "", width: "" });
    $(".searchBar").addClass("searchBar");
    $(".searchForm").css({ width: "" });
    $(".back-button").css({ display: "none" });
    $(".searchButton").css({ "margin-left": "" });
  });
  $(".menu-icon").click(() => {
    if ($("#mySidebar").css("width") === "250px") {
      $("#mySidebar").css("width", "0px");
      $("#main").css("margin-left", "0px");
    } else {
      $("#mySidebar").css("width", "250px");
      $("#main").css("margin-left", "250px");
    }
  });
  $("#mainSection").click(() => {
    $("#mySidebar").css("width", "0px");
    $("#main").css("margin-left", "0px");
  });
});
