<?php

namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;

use Magento\Backend\App\Action;
use SimplifiedMagento\Database\Model\AffiliateMember;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action
{
	protected $affiliateMember;
	protected $jsonFactory;

	public function __construct(
		AffiliateMember $affiliateMember,
		JsonFactory $jsonFactory,
		Action\Context $context)
	{
		$this->affiliateMember = $affiliateMember;
		$this->jsonFactory = $jsonFactory;
		parent::__construct($context);
	}

	/**
	 * Execute action based on request and return result
	 *
	 * @return \Magento\Framework\App\ResponseInterface|ResponseInterface
	 * @throws \Magento\Framework\Exception\NotFoundException
	 */
	public function execute()
	{
		$result = $this->jsonFactory->create();
		$error = false;
		$message = [];

		$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/inline.log');
		$logger = new \Zend\Log\Logger();
		$logger->addWriter($writer);
		$logger->info('Array Log'.print_r($this->getRequest()->getParams(), true));

		if ($this->getRequest()->getParam('isAjax')) {
			$postItems = $this->getRequest()->getParam('items');

			if (!count($postItems)) {
				$message[] = __('Please correct data sent');
				$error = true;
			} else {
				foreach (array_keys($postItems) as $modelId) {
					$model = $this->affiliateMember->load($modelId);
					try {
						$model->setData(array_merge($model->getData(), $postItems[$modelId]));
						$model->save();
					} catch(\Exception $e) {
						$message[] = $e->getMessage();
						$error = true;
					}
				}
			}
		}
		
		return $result->setData([
			'message' => $message,
			'error' => $error
		]);
	}
}