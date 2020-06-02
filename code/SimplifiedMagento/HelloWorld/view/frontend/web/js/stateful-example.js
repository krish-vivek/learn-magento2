define(['uiComponent'], function(Element) {
	'use strict';

	return Element.extend({
		defaults: {
			tracks: {
				input: true
			},
			statefull: {
				input: true
			},
			input: "some random string"
		}
	});
});

