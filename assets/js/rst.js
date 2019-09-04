(function() {
    'use strict';

    const Selectors = {
        form: '.form-rst-helper',
        classificationToggle: 'input[name="classification"]',
        ticketIdField: '#ticketid',
        ticketTitleField: '#title',
        fetchTicket: '[data-action="fetch-ticket"]',
        modal: '#changelogModal',
        flashMessageContainer: '.flashmessage-container'
    };

    let $lastActiveTextarea = null;

    const Rst = {
        initialize: function () {
            if (document.querySelector(Selectors.form) !== null) {
                require('sprintf-js');
                Rst.initializeEvents();
            }
        },
        initializeEvents: function () {
            Rst.togglePalettes('breaking');
            $(document).on('change', Selectors.classificationToggle, function (e) {
                Rst.togglePalettes(e.currentTarget.value);
            }).on('click', Selectors.fetchTicket, Rst.fetchTicket);

            $(Selectors.form).on('submit', Rst.generateDocument);
        },
        fetchTicket: function (e) {
            const ticketIdField = document.querySelector(Selectors.ticketIdField);
            const titleField = document.querySelector(Selectors.ticketTitleField);
            const $trigger = $(e.currentTarget);
            const ticketId = parseInt(ticketIdField.value.replace(/\D/g, ''));

            if (isNaN(ticketId)) {
                return;
            }

            $.ajax({
                url: '/api/issue/' + ticketId,
                dataType: 'json',
                beforeSend: function() {
                    ticketIdField.disabled = true;
                    $trigger.disabled = true;

                    $(Selectors.flashMessageContainer).empty();
                },
                success: function(issue) {
                    titleField.value = issue.subject;
                },
                error: function (xhr) {
                    $(Selectors.flashMessageContainer).append(
                        $('<div/>', {class: 'alert alert-danger alert-dismissible fade show', role: 'alert'}).append(
                            $('<button/>', {type: 'button', class: 'close', 'data-dismiss': 'alert', 'aria-label': 'Close'}).append(
                                $('<span/>', {'aria-hidden': 'true'}).html('&times;')
                            ),
                            $('<strong/>').text(xhr.responseText)
                        ).fadeIn()
                    );
                },
                complete: function() {
                    ticketIdField.disabled = false;
                    $trigger.disabled = false;
                }
            })
        },
        togglePalettes: function (classification) {
            const $palettes = $('[data-classified-as]');
            const $palettesToShow = $palettes.filter(function(index, element) {
                return element.dataset.classifiedAs.indexOf(classification) > -1;
            });
            const $palettesToHide = $palettes.not($palettesToShow);

            $palettesToShow.prop('hidden', false);
            $palettesToShow.find(':input').prop('disabled', false);
            $palettesToHide.prop('hidden', true);
            $palettesToHide.find(':input').prop('disabled', true);
        },
        generateDocument: function (e) {
            e.preventDefault();

            const $modal = $(Selectors.modal);
            const ticketId = document.querySelector(Selectors.ticketIdField).value.replace(/\D/g, '');
            const title = $.trim(document.querySelector(Selectors.ticketTitleField).value);
            const classification = $.trim(document.querySelector(Selectors.classificationToggle + ':checked').parentElement.textContent);
            const headline = sprintf('%s: #%d - %s', classification, ticketId, title);
            const filename = sprintf('%s-%d-%s', classification, ticketId, title.toUpperCamelCase().replace(/[^0-9a-z-_]/gi, '')) + '.rst';

            let restBody = '';
            const forgeRef = 'See :issue:`' + ticketId + '`';
            let restContent = '.. include:: ../../Includes.txt\n\n';
            restContent += sprintf('%s\n%s\n%s\n\n%s', '='.repeat(headline.length), headline, '='.repeat(headline.length), forgeRef);

            $('textarea:visible').each(function () {
                const $me = $(this);
                const label = $me.attr('title');
                const value = $.trim($me.val());

                if (value.length > 0) {
                    restBody += sprintf('\n\n\n%s\n%s\n\n%s', label, '='.repeat(label.length), value);
                }
            });

            const checkedTags = Array.from(document.querySelectorAll('input[name="tag[]"]:checked'));
            if (checkedTags.length > 0) {
                const tags = checkedTags.map(function (tagField) {
                    if (['Feature', 'Important'].indexOf(classification) > -1
                        && ['NotScanned', 'PartiallyScanned', 'FullyScanned'].indexOf(tagField.value) > -1
                    ) {
                        // Filter extension scanner tags in case of being a "Feature" or "Important"
                        return null;
                    }
                    return tagField.value;
                }).filter(tag => tag !== null);

                const extensionTag = document.querySelector('select[name="tag[]"]').value;
                if (extensionTag.length > 0) {
                    tags.push(extensionTag);
                }
                restBody += sprintf('\n\n.. index:: %s', tags.join(', '));
            }
            restContent += restBody.replace('\n', '');

            $modal.find('.modal-title')
                .html('<a href="data:application/octet-stream;charset=utf-8;base64,' + window.btoa(restContent) + '" download="' + filename + '" title="' + filename + '"><i class="fal fa-file-download"></i></a> ' + filename);
            $modal.find('.modal-body textarea').val(restContent);

            $modal.modal({
                backdrop: 'static'
            });
        }
    };

    $(function () {
        Rst.initialize();
    });
})();

String.prototype.toUpperCamelCase = function () {
    return this.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1);
    }).replace(/\s/g, '');
};
