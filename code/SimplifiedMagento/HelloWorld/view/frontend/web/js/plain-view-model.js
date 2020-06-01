define(['ko','jquery'], function (ko, $) {
	'use strict';

	return function(config) {
		// const viewModel = ko.track({
		// 	label: 'A view Model with regular Knockout JS observable',
		// 	additional_change:2,
		// 	items: [
		// 		{name: 'Surprise Box', qty: 4, price: 1.5},
		// 		{name: 'Chunk of Goo', qty: 1, price: 7.5}
		// 	],
		// 	rowTotal: item => item.qty * item.price,
		// 	total: function () {
		// 		const sum = this.items.map(this.rowTotal)
		// 			.reduce((acc, curr) => acc + curr);
		// 		return sum + this.additional_change;
		// 	}
		// 	// exchange_rates: ko.observableArray([
		// 	// 	{
		// 	// 		currency_to: 'USD',
		// 	// 		rate: 1.0
		// 	// 	}
		// 	// ])
		// 	// values: ko.observableArray([
		// 	// 	123,
		// 	// 	12,
		// 	// 	555,
		// 	// 	778
		// 	// ])
		// });

		// ko.getObservable(viewModel, 'additional_change').subscribe(function(newValue) {
		// 	console.log(newValue);
		// });

		//return viewModel;
		// const title= ko.observable('this is a very fine title for a simple but good view model!');
		// title.subscribe(function (newValue){
		// 	console.log('Changed to', newValue);
		// });
		// title.subscribe(function (oldValue){
		// 	console.log('will be changed from', oldValue);
		// }, this, 'beforeChange');

		// let currencyInfo = ko.observable();
		// $.getJSON(config.base_url+'rest/V1/directory/currency', currencyInfo);

		// const viewModel = {
		// 	label: ko.observable("Currency Info")
		// };

		// viewModel.output = ko.computed(function() {
		// 	if (currencyInfo()) {
		// 		return this.label() + ':\n'+JSON.stringify(currencyInfo(), null, 2);
		// 	}
		// 	return '...loading';
		// }.bind(viewModel));

		// return viewModel;

		// return {
		// 	title: title,
		// 	config: config,
		// 	viewModel
		// 	// output: ko.computed(function() {
		// 	// 	return this.label() + ':';
		// 	// })
		// }
	}
});