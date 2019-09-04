(function() {
    'use strict';

    const Selectors = {
        statContainer: 'div.js-stats'
    };

    const QuickStats = {
        initialize: function () {
            if (document.querySelectorAll(Selectors.statContainer).length > 0) {
                QuickStats.setup();
            }
        },
        setup: function () {
            const statContainers = Array.from(document.querySelectorAll(Selectors.statContainer));
            for (let container of statContainers) {
                QuickStats.loadStats(container);
            }
        },
        loadStats: function (container) {
            const sourceUrl = container.dataset.src;

            QuickStats.fetchData(sourceUrl).done(function(response) {
                const keys = Object.keys(response);
                for (let key of keys) {
                    const stat = response[key];
                    const valueContainer = container.querySelector('[data-value="' + key + '"');
                    if (valueContainer !== null) {
                        let valueElement;
                        if (typeof stat.link !== 'undefined') {
                            valueElement = document.createElement('a');
                            valueElement.href = stat.link;
                            valueElement.textContent = stat.value;
                        } else {
                            valueElement = document.createElement('span');
                            valueElement.textContent = stat.value;
                        }
                        valueContainer.innerHTML = '';
                        valueContainer.appendChild(valueElement)
                    }
                }
            });
        },
        fetchData: function (src) {
            return $.ajax(src, {
                dataType: 'json'
            });
        }
    };

    $(function () {
        QuickStats.initialize();
    });
})();
