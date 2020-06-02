define(['uiComponent', 'SimplifiedMagento_HelloWorld/js/counter-state'], function(Component, state) {
	'use strict';

	return Component.extend({
		value: function () {
			return state.counter;
		}
	});
});