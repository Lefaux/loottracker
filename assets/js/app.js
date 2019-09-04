// Load the CSS stuff
require('@fortawesome/fontawesome-pro/css/fontawesome.min.css');
require('@fortawesome/fontawesome-pro/css/brands.min.css');
require('@fortawesome/fontawesome-pro/css/light.min.css');
require('../css/app.scss');

// Load the JS stuff
let $ = require('jquery');
var {DateTime} = require('luxon');
require('bootstrap');
require('./libs/navbar.js');
require('./libs/tagsinput.js');
require('./aggregations.js');
require('./charts.js');
require('./quickstats.js');
require('./rst.js');

document.onreadystatechange = function () {
    if (document.readyState == "interactive") {

        // Syntax Highlight
        if (document.querySelectorAll('[data-processor="syntax-highlight"]')) {
            require('prismjs');
            require('prismjs/components/prism-rest');
        }

        // Expander
        // Unfolds elements where the inner container is smaller than the
        // outer wrap
        Array.from(document.querySelectorAll('.expander')).forEach(function (element) {
            let checkbox = element.getElementsByClassName('expander-checkbox')[0];
            let content = element.getElementsByClassName('expander-content')[0];
            let inner = element.getElementsByClassName('expander-content-inner')[0];
            if (checkbox && content && inner && inner.clientHeight < content.clientHeight) {
                checkbox.checked = true;
            }
        });

        // Format to Local Date
        Array.from(document.querySelectorAll('[data-processor="localdate"]')).forEach(function (element) {
            const value = element.dataset.value;
            element.textContent = DateTime.fromISO(value).toLocaleString({
                month: '2-digit',
                day: '2-digit',
                year: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
        });

        // Format to Relative Time
        Array.from(document.querySelectorAll('[data-processor="relativetime"]')).forEach(function (element) {
            const value = element.dataset.value;
            element.textContent = DateTime.fromISO(value).toRelative();
        });
    }
}
