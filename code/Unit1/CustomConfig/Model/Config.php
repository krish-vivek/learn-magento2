<?php
namespace Unit1\CustomConfig\Model;

use Magento\Framework\Config\CacheInterface;
use Magento\Framework\Config\ReaderInterface;

/**
 * Class Config
 * @package Unit1\CustomConfig\Model
 */
class Config extends \Magento\Framework\Config\Data
{
    /**
     * Config constructor.
     * @param Config\Reader $reader
     * @param CacheInterface $cache
     * @param string $cacheId
     */
    public function __construct(ReaderInterface $reader, CacheInterface $cache, $cacheId = '')
    {
        parent::__construct($reader, $cache, $cacheId);
    }
}