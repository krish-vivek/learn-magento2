define(['uiComponent'], function(Component){
	'use strict';

	return Component.extend({
		defaults:{
			title:'Component B',
			value: 5.5,
			// imports: {
			// 	onAmountUpdate: 'exampleUiComponent:amount'
			// }
			// tracks: {
			// 	value:true
			// }
		},
		// onAmountUpdate: function (newValue) {
		// 	console.log("Update to", newValue);
		// }
	});
});