define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/storage',
    'mage/translate',
    'mage/mage',
    'jquery/ui'
], function ($, modal, storage, $t) {
    'use strict';

    $.widget('training.addTicketApi', {

        /**
         *
         * @private
         */
        _create: function () {
            this._ajaxSubmit();
            this._resetStyleCss();
        },

        /**
         * Set width of the popup
         * @private
         */
        _setStyleCss: function(width) {
            width = width || 400;
            if (window.innerWidth > 786) {
                this.element.parent().parent('.modal-inner-wrap').css({'max-width': width+'px'});
            }
        },

        /**
         * Reset width of the popup
         * @private
         */
        _resetStyleCss: function() {
            var self = this;
            $( window ).resize(function() {
                if (window.innerWidth <= 786) {
                    self.element.parent().parent('.modal-inner-wrap').css({'max-width': 'initial'});
                } else {
                    self._setStyleCss(self.options.innerWidth);
                }
            });
        },

        /**
         * Submit data by Ajax
         * @private
         */
        _ajaxSubmit: function() {
            var self = this,
                form = this.element.find('form.add-ticket'),
                inputElement = form.find('input');
            var ticket_tags = inputElement.find('#ticket_tags').val();
            var tkr = {
                "name":'testfdgfdg',
                "status": true,
                "ticket_type": 1,
                "ticket_tags": "1,2",
                "ticket_lang": "1",
                "ticket_description": "sddffdsfdsfsfsfsfsf",
                "ticket_color": "rgb(1,1,1)"
            };

            inputElement.keyup(function (e) {
                self.element.find('.messages').html('');
            });

            form.submit(function (e) {
                if (form.validation('isValid')) {
                    if (form.hasClass('form add-ticket') || form.hasClass('form add-ticket')) {
                        var formvale = JSON.stringify($(e.target).serializeArray());
                        var name = $.parseJSON(formvale);
                        var multipleValues = $( "#ticket_tags" ).val();
                        if (multipleValues != '') {
                            multipleValues = multipleValues.join( ", " );
                        }
                        var tkr = {
                            "name":name[1].value,
                            "status": name[3].value,
                            "ticket_type": name[4].value,
                            "ticket_tags": multipleValues,
                            "ticket_lang": name[2].value,
                            "ticket_description": $( ".ticket_description-textarea" ).val(),
                            "ticket_color": $( ".colorpicker-input" ).val()
                        };
                        $.ajax({
                            url: $(e.target).attr('action'),
                            data: JSON.stringify({ticket:tkr}),
                            showLoader: true,
                            type: 'POST',
                            dataType: 'json',
                            contentType: "application/json",
                            success: function (response) {
                                response.message = 'data has been saved sucessfully.';
                                self._showResponse(response, form.find('input[name="redirect_url"]').val());
                            },
                            error: function(xhr, status, error) {
                                var err = JSON.parse(xhr.responseText);
                                console.log(err.Message);
                                self._showFailingMessage();
                            }
                        });
                    }
                }
                return false;
            });
        },

        /**
         * Display messages on the screen
         * @private
         */
        _displayMessages: function(className, message) {
            $('<div class="message '+className+'"><div>'+message+'</div></div>').appendTo(this.element.find('.messages'));
        },

        /**
         * Showing response results
         * @private
         * @param {Object} response
         * @param {String} locationHref
         */
        _showResponse: function(response, locationHref) {
            var self = this,
                timeout = 8000;
            this.element.find('.messages').html('');
            if (response.errors) {
                this._displayMessages('message-error error', response.message);
            } else {
                this._displayMessages('message-success success', response.message);
            }
            this.element.find('.messages .message').show();
            setTimeout(function() {
                if (!response.errors) {
                    window.location.href = locationHref;
                }
            }, timeout);
        },

        /**
         * Show the failing message
         * @private
         */
        _showFailingMessage: function() {
            this.element.find('.messages').html('');
            this._displayMessages('message-error error', $t('An error occurred, please try again later.'));
            this.element.find('.messages .message').show();
        }
    });

    return $.training.addTicketApi;
});