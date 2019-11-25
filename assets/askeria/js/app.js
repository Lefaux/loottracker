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
require('selectize/dist/js/selectize.min');
require('./groupbuilder');

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

  $('.typeahead').autocomplete({
    serviceUrl: '/api/select/items',
    paramName: 'q',
    params: {
      'slots': $('#slots').data('slotids')
    },
    onSelect: function (suggestion) {
      let priorityId = this.id.split('_').pop();
      let formField = $('#priority_' + priorityId);
      //console.log(formField);
      formField.val(suggestion.data);
      //alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
    }
  });

  $('.selectize').selectize({
    create: false,
    sortField: 'text'
  });

});

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
          color: '#c24147',
          textColor: 'white',
          extraParams: {
            filters: JSON.stringify({})
          },
          failure: () => {
            // alert("There was an error while fetching FullCalendar!");
          },
        },
      ],
      eventTimeFormat: { // like '14:30:00'
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
      },
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
