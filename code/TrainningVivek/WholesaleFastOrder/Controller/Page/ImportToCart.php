<?php

namespace TrainningVivek\WholesaleFastOrder\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Checkout\Model\Cart;

class ImportToCart extends Action
{
    protected $pageFactory;

    protected $productRepository;

    protected $resultRedirectFactory;

    protected $csv;

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
        \Magento\Framework\File\Csv $csv,
        Context $context)
    {
        $this->resultRawFactory = $resultRawFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->productRepository = $productRepository;
        $this->pageFactory = $pageFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->cart = $cart;
        $this->csv = $csv;
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
        $formKey = isset($params['form_key'])?$params['form_key']:'';

        $data = $this->getRequest()->getFiles();
        if (!empty($data)) {
            $csvData = $this->csv->getData($data->filename['tmp_name']);
            if (!empty($csvData)) {
                foreach ($csvData as $key => $value) {
                    $sku = !empty($value[0])?$value[0]:'';
                    $qty = !empty($value[1])?$value[1]:'';

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