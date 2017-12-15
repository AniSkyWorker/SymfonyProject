$('#review_list').click(function () {
  $("#reviews").show(1);
  $("#guitars").hide(1);
});

$('#guitar_list').click(function () {
  $("#reviews").hide(1);
  $("#guitars").show(1);
});