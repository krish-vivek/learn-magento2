<?php

namespace TrainningVivek\CrudModule\Ui\Component\Listing\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class TicketType extends Column
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                if ($items['ticket_type'] == 1) {
                    $items['ticket_type'] = 'Type 1';
                } elseif ($items['ticket_type'] == 2) {
                    $items['ticket_type'] = 'Type 2';
                } else {
                    $items['ticket_type'] = 'Type 3';
                }
            }
        }
        return $dataSource;
    }
}