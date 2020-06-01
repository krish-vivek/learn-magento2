define(['uiElement'], function(UiElement){
	'use strict';

	return UiElement.extend({
		defaults: {
			template: 'SimplifiedMagento_HelloWorld/ui-component-template',
			label: "Some Random numbers",
			values: [22, 1, 5, 1024, 777]
		}
	});
});