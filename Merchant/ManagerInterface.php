<?php
namespace Sergeym\ReceiptBundle\Merchant;


use Sergeym\ReceiptBundle\Model\Receipt;

interface ManagerInterface
{
    public function __construct($template);
    public function fillRecieptWithMerchantData(Receipt $receipt);
}