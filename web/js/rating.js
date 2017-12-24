$('#rating-input').rating({
  extendSymbol: function (rate) {
    $(this).tooltip({
      container: 'body',
      placement: 'bottom',
      title: 'Rate ' + rate
    });
  }
});

$('#rating-input').on('change', function () {
  $(this).parent().find('#review-form').show(1);
});