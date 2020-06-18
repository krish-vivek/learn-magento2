<?php

namespace Lof\LayeredNavigation\Block\Html;

class Pager extends \Magento\Theme\Block\Html\Pager{

    public function checkParam(){
        if( $this->getRequest()->getParam('in-stock') != null) {
            $filter = $this->getRequest()->getParam('in-stock');
            $result = $this->getStockCollection($filter);
            return $result;
        }else{
            return null;
        }
    }

    public function getStockCollection($value){

        $collection = $this->getCollection();
        $select = clone $collection->getSelect();
        if (strpos($value, ',') == false) {
            $select->where('stock_status_idx.stock_status = ?',$value);
        }
        $select->reset(\Magento\Framework\DB\Select::LIMIT_COUNT);
        $result = $collection->getConnection()->fetchall($select);

        return $result;
    }
    public function getLastPageNum()
    {   if($this->checkParam() != null){
        if(count($this->checkParam()) > $this->getLimit()){
            return ceil(count($this->checkParam())/$this->getLimit()) ;
        }else{

            return 0;
        }
    }else {
        return $this->getCollection()->getLastPageNumber();
    }
    }
}