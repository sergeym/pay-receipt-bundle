<?php

namespace Sergeym\ReceiptBundle\DependencyInjection;

use Sergeym\ReceiptBundle\Merchant\MerchantDataLoaderManagerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SergeymReceiptExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $managerClass = $config['manager_class'];
        $definition = new Definition();
        $definition->setClass($managerClass);
        $definition->setArguments([ $config['template'] ]);

        if (in_array(MerchantDataLoaderManagerInterface::class, class_implements($managerClass))) {
            $definition->addMethodCall('loadMerchantData', [ $config['merchant'] ]);
        }

        $container->setDefinition('sergeym_receipt.merchant.manager', $definition);
    }
}
