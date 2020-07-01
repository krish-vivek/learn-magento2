<?php

namespace TrainningVivek\WholesaleFastOrder\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Checkout\Model\Cart;

class AddToCart extends Action
{
    protected $pageFactory;

    protected $productRepository;

    protected $resultRedirectFactory;

    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    protected $resultRawFactory;

    public function __construct(PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        Cart $cart,
        Context $context)
    {
        $this->resultRawFactory = $resultRawFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->productRepository = $productRepository;
        $this->pageFactory = $pageFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->cart = $cart;
        parent::__construct($context);
    }

    public function execute()
    {
        $credentials = null;
        $httpBadRequestCode = 400;

        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultRawFactory->create();
        if ($this->getRequest()->getMethod() !== 'POST') {
            return $resultRaw->setHttpResponseCode($httpBadRequestCode);
        }

        $formKeyValidation = $this->formKeyValidator->validate($this->getRequest());

        $params = $this->getRequest()->getParams();
        $formKey = $params['form_key'];
        if (!empty($params['cartsku'])) {
            $productArray = [];

            foreach ($params['cartsku'] as $key => $row) {
                if (!empty($row)) {
                    $int = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
                    $productArray[$int][$key] = $row;
                }
            }

            if (!empty($productArray)) {
                foreach ($productArray as $key => $value) {
                    $sku = '';
                    $qty = '';

                    $sku = !empty($value['code'.$key])?$value['code'.$key]:'';
                    $qty = !empty($value['suq'.$key])?$value['suq'.$key]:'';

                    if (!empty($sku) && !empty($qty)) {
                        $product = $this->productRepository->get($sku);
                        if (!empty($product)) {
                            $params = array(
                                'form_key' => $formKey,
                                'product' => $product->getId(),
                                'qty' => $qty
                            );
                            $this->cart->addProduct($product, $params);
                            $this->cart->save();
                        }
                    }
                }
            }
        }
        
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('checkout/cart');
        return $resultRedirect;
    }
}