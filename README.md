Receipt Bundle
 
This bundle creates printable form of pay receipt PD-14 usualy used in banks of Russia.
 
### Step 1: Download SergeymReceiptBundle using composer

```
composer require sergeym/pay-receipt-bundle:dev-master
```
or add to your composer json
```json
{
    "require": {
        "sergeym/pay-receipt-bundle": "dev-master"
    }
}
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Sergeym\ReceiptBundle\SergeymReceiptBundle()
    );
}
```

### Step 3: Update app/config.yml

``` yaml
sergeym_receipt:
    template:
        pd4: SergeymReceiptBundle:Default:pd4.html.twig # ../recipe/pd4 or just ../recipe because it default value
        # add more pay receipt form templates here
    merchant:
        1: # merchant_id
            extra:
                payee: ~
                okato: ~
                inn: ~
                kpp: ~
                account: ~
                bank: ~
                correspondent_account: ~
                bik: ~
                #add more extra field for template injection using {{ receipt.extra('extra-name') }}
        # you can add more merchants
```

###  Step 3: Routing

``` yaml
# app/config/routing.yml
sergeym_receipt:
    resource: "@SergeymReceiptBundle/Resources/config/routing.yml"
    prefix:   /
```

### How it works?

Post request to */receipt* or */receipt/{receipt_form_name}*, where *{receipt_form_name}* is template name in *sergeym_receipt.template section* in config.yml

POST data:

```
post_code
post_address
payer_name
name
merchant_id
currency_code
currency_digits_after_decimal_point
total_amount
return_url
```