<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\CustomConfig\Model\Config;

class Converter implements \Magento\Framework\Config\ConverterInterface
{
    /**
     * Convert dom node tree to array
     *
     * @param \DOMDocument $source
     * @return array
     * @throws \InvalidArgumentException
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function convert($source)
    {
        $output = [];
        $xpath = new \DOMXPath($source);
        $messages = $xpath->evaluate('/config/welcome_message');
        /** @var $messageNode \DOMNode */
        foreach ($messages as $messageNode) {
            $storeId = $this->_getAttributeValue($messageNode, 'store_id');

            $data = [];
            /** @var $childNode \DOMNode */
            foreach ($messageNode->childNodes as $childNode) {
                $data = ['message' => $childNode->nodeValue];
            }
            $output['messages'][$storeId] = $data;
        }

        return $output;
    }

    /**
     * Get attribute value
     *
     * @param \DOMNode $input
     * @param string $attributeName
     * @param string|null $default
     * @return null|string
     */
    protected function _getAttributeValue(\DOMNode $input, $attributeName, $default = null)
    {
        $node = $input->attributes->getNamedItem($attributeName);
        return $node ? $node->nodeValue : $default;
    }
}
