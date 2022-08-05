<?php

namespace Perspective\Admin\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Perspective\Admin\Helper\DataHelper;
use \Magento\Catalog\Model\ProductRepository;
use \Magento\CatalogInventory\Api\StockStateInterface;
use \Magento\Framework\Registry;


class Admin extends Template
{
    /**
     * @var DataHelper
     */
    protected $helperData;

    /**
     * @param DataHelper $helperData
     * @param ProductRepository $productRepository
     * @param StockStateInterface $stockState
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        DataHelper $helperData,
        ProductRepository $productRepository,
        StockStateInterface $stockState,
        Registry $registry,
        array $data = [])
        
    {
        $this->_registry = $registry;
        $this->_productRepository = $productRepository;
        $this->helperData = $helperData;
        $this->stockState = $stockState;
        parent::__construct($context, $data);
    }

    public function currentProduct() {
        return $this->_registry->registry('current_product');
    }

    public function priceProduct() {
        return $this->_productRepository->getById($this->currentProduct()->getId() - 1)->getPrice();
    }
        
    public function getExchangeRatesUAH()
    {   
        if ($this->helperData->getGeneralConfig('enable_ua') == 1) {
            return $this->priceProduct() * $this->helperData->getGeneralConfig('ua');
        } else {
            return null;
        }
    }

    public function getExchangeRatesRUS()
    {   
        if ($this->helperData->getGeneralConfig('enable_ru') == 1) {
            return $this->priceProduct() * $this->helperData->getGeneralConfig('ru');
        } else {
            return null;
        }
    }

    public function getExchangeRatesEURO()
    {   
        if ($this->helperData->getGeneralConfig('enable_euro') == 1) {
            return $this->priceProduct() * $this->helperData->getGeneralConfig('euro');
        } else {
            return null;
        }
    }

    public function getQty() 
    {
        return $this->stockState->getStockQty($this->currentProduct()->getId()-1); 
    }

    public function getTest() {
        return $this->helperData->getGeneralConfigTwo('number_product');
    }
}
