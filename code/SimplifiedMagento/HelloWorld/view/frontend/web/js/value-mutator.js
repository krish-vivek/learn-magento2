define(['uiComponent', 'SimplifiedMagento_HelloWorld/js/counter-state'], function(Component, state) {
	'use strict';

	return Component.extend({
		inc: function() {
			return state.increment;
		},
		increment: function () {
			state.counter += state.increment;
		}
	});
});