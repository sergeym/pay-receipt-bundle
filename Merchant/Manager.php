<?php

namespace Sergeym\ReceiptBundle\Merchant;

use Doctrine\Common\Collections\ArrayCollection;
use Sergeym\ReceiptBundle\Model\Receipt;
use Symfony\Component\DependencyInjection\Container;

class Manager extends AbstractManager implements MerchantDataLoaderManagerInterface
{
    public function loadMerchantData($merchantData)
    {
        $this->merchantData = new ArrayCollection($merchantData);
    }
}
