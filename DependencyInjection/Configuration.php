<?php

namespace Nicosomb\WallabagCarbondateBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('nicosomb_wallabag_carbondate');

        $rootNode
            ->children()
                ->scalarNode('url')
                    ->defaultValue('http://carbondate.cs.odu.edu')
                ->end()
                ->scalarNode('enabled')
                    ->defaultValue('true')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
