<?php

namespace Perspective\Admin\Block;

use \Magento\Catalog\Block\Product\ListProduct;
use \Perspective\Admin\Helper\DataHelper;
use \Magento\CatalogInventory\Api\StockStateInterface;
use \Magento\Framework\Registry;
use \Magento\Framework\Url\Helper\Data;
use \Magento\Catalog\Block\Product\Context;
use \Magento\Framework\Data\Helper\PostHelper;
use \Magento\Catalog\Model\Layer\Resolver;
use \Magento\Catalog\Api\CategoryRepositoryInterface;

class TaskTwo extends ListProduct
{

    /**
     * @var DataHelper
     */
    protected $helperData;

    /**
     * @param DataHelper $helperData
     * @param StockStateInterface $stockState
     * @param Registry $registry
     * @param Data $urlHelper
     * @param PostHelper $postDataHelper
     * @param Resolver $layerResolver
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        DataHelper $helperData,
        StockStateInterface $stockState,
        Registry $registry,
        Data $urlHelper,
        Context $context,
        PostHelper $postDataHelper,
        Resolver $layerResolver,
        CategoryRepositoryInterface $categoryRepository,
    
        array $data = [])

    {
        $this->_registry = $registry;
        $this->helperData = $helperData;
        $this->stockState = $stockState;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
    }

    public function getQty($_product) 
    {
            return $this->stockState->getStockQty($_product); 
    }

    public function getNumber()
    {
        if ($this->helperData->getGeneralConfigTwo('number_on') == 1) {
            return $this->helperData->getGeneralConfigTwo('number_product');
        }
    }
}
