var config = {
	/*deps: ['SimplifiedMagento_HelloWorld/js/log-when-loaded'],*/
	map: {
		'*': {
			coffee: 'SimplifiedMagento_HelloWorld/js/requirejs-example'
		}
	},
	config: {
		mixins: {
			'Magento_Checkout/js/checkout-data': {
				'SimplifiedMagento_HelloWorld/js/checkout-data-mixin':true
			},
			'Magento_Catalog/js/catalog-add-to-cart': {
				"SimplifiedMagento_HelloWorld/js/add-to-cart-mixin":true
			}
		}
	},
	/*shim: {
		'Magento_Catalog/js/view/compare-products':{
			deps: ['SimplifiedMagento_HelloWorld/js/before-compare-products-example']
		}
	},
	paths: {
		'simplifiedMagento':'SimplifiedMagento_HelloWorld/js/v2',
		'simplifiedMagento-title':'SimplifiedMagento_HelloWorld/js/v1/title'
	}*/
};