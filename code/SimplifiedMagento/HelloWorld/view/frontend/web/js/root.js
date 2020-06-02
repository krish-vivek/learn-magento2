define(['uiComponent'], function(UiComponent) {
	'use strict';

	return UiComponent.extend({
		defaults: {
			imports: {
				value: "root.sharedState:value"
			},
			value: 0
		}
	});
});