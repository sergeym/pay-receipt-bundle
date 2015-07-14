<?php

namespace Sergeym\ReceiptBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Receipt {

    private $post_code;
    private $post_address;
    private $payer_name;
    private $name;

    private $total_amount;
    private $currency_code;
    private $currency_digits_after_decimal_point;
    private $merchant_id;

    private $return_url;
    private $extra;
    private $template;

    /**
     * Receipt constructor.
     */
    public function __construct()
    {
        $this->extra = new ArrayCollection();
    }


    public function getTotal()
    {
        $result = sprintf('%d.%d', $this->getTotalInteger(), $this->getTotalFractional());
        return floatval($result);
    }

    public function getTotalInteger()
    {
        $dadp = (int)$this->getCurrencyDigitsAfterDecimalPoint();
        $result = $this->getTotalAmount();

        if ($dadp>0) {
            $result = substr($result,0, (-1*$dadp));
        }

        return intval($result);
    }

    public function getTotalFractional()
    {
        $dadp = (int)$this->getCurrencyDigitsAfterDecimalPoint();
        $result = 0;

        if ($dadp>0) {
            $result = substr($result, (-1*$dadp), $dadp);
        }

        return intval($result);
    }

    /**
     * @return mixed
     */
    public function getPostCode()
    {
        return $this->post_code;
    }

    /**
     * @param mixed $post_code
     */
    public function setPostCode($post_code)
    {
        $this->post_code = $post_code;
    }

    /**
     * @return mixed
     */
    public function getPostAddress()
    {
        return $this->post_address;
    }

    /**
     * @param mixed $post_address
     */
    public function setPostAddress($post_address)
    {
        $this->post_address = $post_address;
    }

    /**
     * @return mixed
     */
    public function getPayerName()
    {
        return $this->payer_name;
    }

    /**
     * @param mixed $payer_name
     */
    public function setPayerName($payer_name)
    {
        $this->payer_name = $payer_name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * @param mixed $total_amount
     */
    public function setTotalAmount($total_amount)
    {
        $this->total_amount = $total_amount;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->currency_code;
    }

    /**
     * @param mixed $currency_code
     */
    public function setCurrencyCode($currency_code)
    {
        $this->currency_code = $currency_code;
    }

    /**
     * @return mixed
     */
    public function getCurrencyDigitsAfterDecimalPoint()
    {
        return $this->currency_digits_after_decimal_point;
    }

    /**
     * @param mixed $currency_digits_after_decimal_point
     */
    public function setCurrencyDigitsAfterDecimalPoint($currency_digits_after_decimal_point)
    {
        $this->currency_digits_after_decimal_point = $currency_digits_after_decimal_point;
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->merchant_id;
    }

    /**
     * @param mixed $merchant_id
     */
    public function setMerchantId($merchant_id)
    {
        $this->merchant_id = $merchant_id;
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->return_url;
    }

    /**
     * @param mixed $return_url
     */
    public function setReturnUrl($return_url)
    {
        $this->return_url = $return_url;
    }

    /**
     * @return ArrayCollection
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param ArrayCollection $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    /**
     * @param $offset
     * @param $value
     */
    public function addExtra($offset, $value)
    {
        $this->extra->offsetSet($offset, $value);
    }

    /**
     * for twig
     */
    public function extra($offset)
    {
        $result = '';
        if ($this->extra->offsetExists($offset)) {
            $result = $this->extra->get($offset);
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
}