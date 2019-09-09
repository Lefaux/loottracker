// Load the CSS stuff
require('@fortawesome/fontawesome-pro/css/fontawesome.min.css');
require('@fortawesome/fontawesome-pro/css/brands.min.css');
require('@fortawesome/fontawesome-pro/css/light.min.css');
require('../css/app.scss');

// Load the JS stuff
let $ = require('jquery');
require('bootstrap');
require('./libs/navbar.js');

require('blueimp-tmpl');
require('blueimp-file-upload/js/jquery.fileupload');
require('blueimp-file-upload/js/jquery.fileupload-image');
require('blueimp-file-upload/js/jquery.fileupload-process');
require('blueimp-file-upload/js/jquery.fileupload-validate');
require('blueimp-file-upload/js/jquery.fileupload-ui');

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
});

document.onreadystatechange = function () {
};
