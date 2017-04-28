<?php

namespace Nicosomb\WallabagCamoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class NicosombWallabagCamoExtension extends Extension
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
        $container->setParameter('nicosomb_wallabag_carbondate.url', $config['url']);
        $container->setParameter('nicosomb_wallabag_carbondate.enabled', $config['enabled']);
    }

    public function getAlias()
    {
        return 'nicosomb_wallabag_camo';
    }
}
