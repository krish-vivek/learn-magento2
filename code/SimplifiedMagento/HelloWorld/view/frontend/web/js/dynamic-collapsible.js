define(['jquery','collapsible'], function($){
	'use strict';

	const waitForUpdate = function() {
		if (! this.content.attr('aria-busy')) {
			return this.content.trigger('contentUpdate');
		}
		setTimeout(waitForUpdate.bind(this), 100);
	}

	$.widget('simplifiedMagento.collapsible', $.mage.collapsible, {
		_loadContent: function() {
			this._super();
			waitForUpdate.bind(this)();
		}
	})

	return $.simplifiedMagento.collapsible;
});