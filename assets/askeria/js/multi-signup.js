$(function () {

  let checkMultipleColumns = function() {
    let characterId = $(this).data('character');
    let responseType = $(this).data('response');
    $('input:radio[data-response=' + responseType  + '][data-character=' + characterId  + ']').prop('checked', true);
  };
  $('.multisignup-col').on("click", checkMultipleColumns);

  let checkMultipleRows = function() {
    let eventId = $(this).data('event');
    let responseType = $(this).data('response');
    $('input:radio[data-response=' + responseType  + '][data-event=' + eventId  + ']').prop('checked', true);
  };
  $('.multisignup-row').on("click", checkMultipleRows);

  let checkAll = function() {
    let responseType = 'yes';
    $('input:radio[data-response=' + responseType  + ']').prop('checked', true);
  };
  $('.multisignup-all').on("click", checkAll);

});