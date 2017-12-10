$('input').rating({
  extendSymbol: function (rate) {
    $(this).tooltip({
      container: 'body',
      placement: 'bottom',
      title: 'Rate ' + rate
    });
  }
});
$('input').on('change', function () {
  alert('Rating: ' + $(this).val());
});