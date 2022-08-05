<?php
namespace Perspective\Admin\Controller\Adminhtml;

class Index extends \Magento\Framework\AuthorizationInterface
{

    public function __construct(
        \Magento\Framework\AuthorizationInterface $AuthorizationInterface)
    {
        return $AuthorizationInterface;
    }
    
    protected function _isAllowed()
    {
            return $this->_authorization->isAllowed('Magento_Customer::manage');
    }
}