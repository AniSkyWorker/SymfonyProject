$('#review_list').click(function () {
  $("#reviews").show(1);
  $("#guitars").hide(1);
});

$('#guitar_list').click(function () {
  $("#reviews").hide(1);
  $("#guitars").show(1);
});

$("#guitars tr").hover(
  function() {
    $(this).find("#btn-td").find("#delete-guitar-btn").show(1);
  }, function() {
    $(this).find("#btn-td").find("#delete-guitar-btn").hide(1);
  }
);