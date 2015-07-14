<?php

namespace Sergeym\ReceiptBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReceiptType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('post_code', 'integer', ['required' => true, 'label'=>'sergeym_reciept.form.post_code'])
            ->add('post_address', 'text', ['required' => true, 'label'=>'sergeym_reciept.form.post_address'])
            ->add('payer_name', 'text', ['required' => true, 'label'=>'sergeym_reciept.form.payer_name'])
            ->add('name', 'hidden')
            ->add('merchant_id', 'hidden')
            ->add('currency_code', 'hidden')
            ->add('currency_digits_after_decimal_point', 'hidden')
            ->add('total_amount', 'hidden')
            ->add('return_url','hidden');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Sergeym\ReceiptBundle\Model\Receipt',
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }


    /**
     * @return string
     */
    public function getName()
    {
        return;
    }
}
