define(['uiComponent', 'jquery'], function(Component, $){
	'use strict';

	return Component.extend({
		// defaults: {
		// 	template: 'SimplifiedMagento_HelloWorld/ui-component-template',
		// 	label: "Some Random numbers",
		// 	values: [22, 1, 5, 1024, 777]
		// }
		getTitle: function() {
			const remaining = 60 - new Date().getSeconds();
			return $.mage.__('Place order within %1 seconds!').replace('%1', remaining);
		}
	});
});