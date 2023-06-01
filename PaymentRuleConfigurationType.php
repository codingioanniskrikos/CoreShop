<?php

declare(strict_types=1);

/*
 * CoreShop
 *
 * This source file is available under two different licenses:
 *  - GNU General Public License version 3 (GPLv3)
 *  - CoreShop Commercial License (CCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GPLv3 and CCL
 *
 */

namespace CoreShop\Bundle\PaymentBundle\Form\Type\Rule\Common;

use CoreShop\Bundle\PaymentBundle\Form\Type\PaymentProviderRuleChoiceType;
use CoreShop\Component\Payment\Model\PaymentProviderRuleInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class PaymentProviderRuleConfigurationType extends AbstractType
{
    /**
     * @param string[] $validationGroups
     */
    public function __construct(
        protected array $validationGroups,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('paymentProviderRule', PaymentProviderRuleChoiceType::class, [
                'constraints' => [
                    new NotBlank(['groups' => $this->validationGroups]),
                ],
            ])
        ;

        $builder->get('paymentProviderRule')->addModelTransformer(new CallbackTransformer(
            function (mixed $paymentProviderRule) {
                if ($paymentProviderRule instanceof PaymentProviderRuleInterface) {
                    return $paymentProviderRule->getId();
                }

                return null;
            },
            function (mixed $paymentProviderRule) {
                if ($paymentProviderRule instanceof PaymentProviderRuleInterface) {
                    return $paymentProviderRule->getId();
                }

                return null;
            },
        ));
    }

    public function getBlockPrefix(): string
    {
        return 'coreshop_payment_rule_condition_payment_rule';
    }
}
