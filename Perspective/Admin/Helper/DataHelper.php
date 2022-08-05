<?php

namespace Perspective\Admin\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class DataHelper extends AbstractHelper
{

	const XML_PATH_HELLOWORLD = 'helloworld/';
	const XML_PATH_NUMBER = 'number/';

	public function getConfigValue($field, $storeId = null)
	{
		return $this->scopeConfig->getValue(
			$field, ScopeInterface::SCOPE_STORE, $storeId
		);
	}

	public function getGeneralConfig($code, $storeId = null)
	{

		return $this->getConfigValue(self::XML_PATH_HELLOWORLD .'general/'. $code, $storeId);
	}

	public function getGeneralConfigTwo($code, $storeId = null)
	{
		return $this->getConfigValue(self::XML_PATH_NUMBER . 'number_group/'. $code, $storeId);
	}
}
