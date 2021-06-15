// Load the CSS stuff
require('@fortawesome/fontawesome-free/css/all.min.css');
require('../css/app.scss');

// Load the JS stuff
global.$ = global.jQuery = require('jquery');
require('bootstrap');
require('../../js/libs/navbar.js');
require('select2');

require('blueimp-tmpl');
require('blueimp-file-upload/js/jquery.fileupload');
require('blueimp-file-upload/js/jquery.fileupload-image');
require('blueimp-file-upload/js/jquery.fileupload-process');
require('blueimp-file-upload/js/jquery.fileupload-validate');
require('blueimp-file-upload/js/jquery.fileupload-ui');
require('devbridge-autocomplete/dist/jquery.autocomplete.min');
require('./groupbuilder');
require('./multi-signup');

$(function () {
  'use strict';
  let $fileUploadForm = $('#fileupload');

  $fileUploadForm.fileupload({
    url: $fileUploadForm.data('url'),
    limitConcurrentUploads: 2,
    maxChunkSize: 10000000,
    maxNumberOfFiles: parseInt($fileUploadForm.data('maxnumberoffiles')),
  });

  $fileUploadForm.fileupload('option', {
    disableImageResize: /Android(?!.*Chrome)|Opera/
      .test(window.navigator.userAgent),
    maxFileSize: 999000,
    acceptFileTypes: /(\.)(lua)$/i
  });

  $('.typeahead').select2({
    ajax: {
      url: '/api/select/items',
      dataType: 'json',
      data: function (params) {
        return {
          search: params.term,
          slots: $('#slots').data('slotids')
        };
      }
    },
    minimumInputLength: 3,
    placeholder: 'Search for an item',
    theme: 'default',
    templateResult: formatState
  });

  $('.recipe-typeahead').select2({
    ajax: {
      url: '/api/select/recipe',
      dataType: 'json',
      data: function (params) {
        return {
          search: params.term
        };
      }
    },
    minimumInputLength: 3,
    placeholder: 'Search for a recipe',
    theme: 'default',
    templateResult: formatState
  });
});



/**
 * Format BiS Item Search Result
 * @param state
 * @returns {*|jQuery|HTMLElement}
 */
function formatState (state) {
  if (!state.id) {
    return state.text;
  }
  let baseUrl = "https://wow.zamimg.com/images/wow/icons/medium";
  let $state = $(
      '<div class="searchresult-container">' +
      '  <div class="searchresult-icon">' +
      '    <img src="' + baseUrl + '/' + state.icon + '.jpg" />' +
      '  </div> ' +
      '  <div class="searchresult-text">' +
      '    <span class="q' + state.quality + '" data-wowhead="item=' + state.id + '"> ' + state.text + '</span> (ID: ' + state.id + ')' +
      '    <br>' +
      '    <span class="ilvl q' + state.quality + '">LvL: ' + state.ilvl + '</span> (' + state.zone + ')' +
      '  </div> ' +
      '</div>'
  );
  return $state;
}

document.addEventListener('DOMContentLoaded', () => {
  let calendarEl = document.getElementById('calendar-holder');

  if (calendarEl !== null) {
    let calendar = new FullCalendar.Calendar(calendarEl, {
      defaultView: 'dayGridMonth',
      editable: false,
      firstDay: 1,
      eventSources: [
        {
          url: "/fc-load-events",
          method: "POST",
          // color: '#c24147',
          textColor: 'white',
          extraParams: {
            filters: JSON.stringify({})
          },
          failure: () => {
            // alert("There was an error while fetching FullCalendar!");
          },
        },
      ],
      displayEventTime: false,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: '',
      },
      plugins: [ 'dayGrid', 'timeGrid' ], // https://fullcalendar.io/docs/plugin-index
      timeZone: 'UTC',
    });
    calendar.render();
  }


});

document.onreadystatechange = function () {
};
