<?php

namespace Sergeym\ReceiptBundle\Controller;

use Sergeym\ReceiptBundle\Form\Type\ReceiptType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request, $receipt_form_name)
    {
        $form = $this->createForm(new ReceiptType())
                     ->add('update', 'submit', ['label' => 'sergeym_reciept.form.update'])
                     ->add('print', 'button', ['label' => 'sergeym_reciept.form.print']);

        $form->handleRequest($request);

        $receipt = $form->getData();

        $manager = $this->getManager();

        $manager->fillRecieptWithMerchantData($receipt);

        $template = $manager->getTemplate($receipt_form_name);

        return $this->render($template, [
            'receipt' => $receipt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return \Sergeym\ReceiptBundle\Merchant\Manager
     */
    private function getManager()
    {
        return $this->get('sergeym_receipt.merchant.manager');
    }
}
