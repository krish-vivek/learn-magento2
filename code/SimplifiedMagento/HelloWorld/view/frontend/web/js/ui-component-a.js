define(['uiComponent'], function (Component){
	'use strict';

	return Component.extend({
		defaults:{
			label:'Component A',
			amount: 11,
			// exports: {
			// 	amount: 'exampleUiComponentB:value'
			// }
			// links: {
			// 	amount: 'exampleUiComponentB:value'
			// },
			tracks: {
				amount:true
			},
			imports: {
				amount: '${$.provider}:value'
			}
		}
	});
});