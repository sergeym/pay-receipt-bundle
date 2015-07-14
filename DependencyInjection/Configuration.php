<?php

namespace Sergeym\ReceiptBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sergeym_receipt');

        $rootNode->children()
            ->scalarNode('manager_class')->defaultValue('Sergeym\ReceiptBundle\Merchant\Manager')->end()
            ->arrayNode('template')
                ->useAttributeAsKey('name')
                ->prototype('scalar')->end()
            ->end()
            ->arrayNode('merchant')
                ->useAttributeAsKey('name')
                ->prototype('array')
                        ->children()
                            ->arrayNode('extra')
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
        ->end();

        return $treeBuilder;
    }
}
