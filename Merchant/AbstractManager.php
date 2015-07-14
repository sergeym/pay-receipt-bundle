<?php

namespace Sergeym\ReceiptBundle\Merchant;

use Doctrine\Common\Collections\ArrayCollection;
use Sergeym\ReceiptBundle\Model\Receipt;
use Symfony\Component\DependencyInjection\Container;

abstract class AbstractManager implements ManagerInterface
{
    protected $merchantData = [];
    protected $templates;

    public function __construct($templateList)
    {
        $this->templates = new ArrayCollection($templateList);
    }


    public function fillRecieptWithMerchantData(Receipt $receipt)
    {
        $merchant_id = $receipt->getMerchantId();

        if (!isset($this->merchantData[$merchant_id])) {
            throw new BadConfigurationException(sprintf('There is no configuration for merchant with id=%s', $merchant_id));
        }

        $config = $this->merchantData[$merchant_id]['extra'];

        foreach($config as $key => $value) {
            $receipt->addExtra($key, $value);
        }
    }

    public function getTemplate($receiptName)
    {
        return $this->templates->offsetGet($receiptName);
    }


}
