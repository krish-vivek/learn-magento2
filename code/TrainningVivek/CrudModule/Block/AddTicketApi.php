<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TrainningVivek\CrudModule\Block;

use Magento\Framework\View\Element\Template;
use TrainningVivek\CrudModule\Model\MarsTicketRepository;

/**
 * Customer account navigation sidebar
 *
 * @api
 * @since 100.0.2
 */
class AddTicketApi extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface|null
     */
    protected $_ticket = null;

    /**
     * @param Template\Context $context
     * @param Url $customerUrl
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        MarsTicketRepository $marsTicketRepository,
        array $data = []
    ) {
        $this->marsTicketRepository = $marsTicketRepository;
        parent::__construct($context, $data);
    }

    /**
     * Prepare the layout of the address edit block.
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->initTicketObject();
        return $this;
    }

    /**
     * Initialize ticket object.
     *
     * @return void
     */
    private function initTicketObject()
    {
        // Init address object
        if ($ticketId = $this->getRequest()->getParam('id')) {
            try {
                $this->_ticket = $this->marsTicketRepository->getMarsTicketById($ticketId);
            } catch (NoSuchEntityException $e) {
                $this->_ticket = null;
            }
        }

        return $this;
    }

    /**
     * Retrieve the form posting URL
     *
     * @return string
     */
    public function getPostActionUrl()
    {
        return $this->getUrl('rest/V1/mars_ticket');
    }

    /**
     * Return the associated address.
     *
     * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
     */
    public function getTicket()
    {
        return $this->_ticket;
    }

    /**
     * Returns country html select
     *
     * @return string
     */
    public function getTagsSelect($tags = null)
    {
        $tagArray = [];

        $options = [ 
            1 => ['value' => 1, 'label' => 'Tag 1'], 
            2 => ['value' => 2, 'label' => 'Tag 2'],
            3 => ['value' => 3, 'label' => 'Tag 3']
        ];

        if (!empty($tags)) {
           $tagArray = explode(',', $tags);
        }

        $html = $this->getLayout()->createBlock(
            \Magento\Framework\View\Element\Html\Select::class
        )->setName(
            'ticket[ticket_tags][]'
        )->setId(
            'ticket_tags'
        )->setTitle(
            $this->escapeHtml(__('Ticket Tags'))
        )->setValue(
            ''
        )->setOptions(
            $options
        )->setExtraParams(
            'data-validate="{\'validate-select\':true}" multiple="multiple"'
        )->setValue(
            $tagArray
        )->getHtml();

        \Magento\Framework\Profiler::stop('TEST: ' . __METHOD__);
        return $html;
    }

    /**
     * Returns country html select
     *
     * @return string
     */
    public function getTypeSelect($type = null)
    {
        $options = [ 
            1 => ['value' => 1, 'label' => 'Type 1'], 
            2 => ['value' => 2, 'label' => 'Type 2'],
            3 => ['value' => 3, 'label' => 'Type 3']
        ];


        $html = $this->getLayout()->createBlock(
            \Magento\Framework\View\Element\Html\Select::class
        )->setName(
            'ticket[ticket_type]'
        )->setId(
            'ticket_type'
        )->setTitle(
            $this->escapeHtml(__('Ticket Type'))
        )->setValue(
            ''
        )->setOptions(
            $options
        )->setExtraParams(
            'data-validate="{\'validate-select\':true}"'
        )->setValue(
            $type
        )->getHtml();

        \Magento\Framework\Profiler::stop('TEST: ' . __METHOD__);
        return $html;
    }
}
