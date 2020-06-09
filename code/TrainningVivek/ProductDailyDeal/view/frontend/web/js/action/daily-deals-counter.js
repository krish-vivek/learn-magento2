define([
    'jquery',
    'mage/translate',
    'kinectic',
    'counterlib'
], function ($, $t, Kinetic, counterlib) {
    'use strict';


    $.widget('training.productDailyDeal', {
        /**
         *
         * @private
         */
        _create: function (options, callback) {
            var self = this;
            var end_time = this.options.deal_time;
            var start_time = this.options.now;
            $('.countdown').final_countdown({
                'start': start_time,
                'end': end_time,
                'now': start_time        
            });  
        }
    });

    return $.training.productDailyDeal;
});