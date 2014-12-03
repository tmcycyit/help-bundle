<?php

namespace Yit\HelpBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class YitHelpExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        //get secure from config
        if(isset($config['secure']))
        {
            $secure = $config['secure']; // if set, get from config
        }
        else
        {
            $secure = true; // else set default value
        }

        //insert secure
        $container->setParameter($this->getAlias() . '.help_secure', $secure);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        // get all Bundles
        $bundles = $container->getParameter('kernel.bundles');

        // Get configuration of our own bundle
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        if (isset($bundles['AsseticBundle'])) //is assetic bundle set
        {
            //array for assetic
            $insertionForAssetic = array('bundles' => array( 'YitHelpBundle' ));

            // insert assetic bundle name  into config.yml
            foreach ($container->getExtensions() as $name => $extension)
            {
                switch ($name)
                {
                    case 'assetic':
                        $container->prependExtensionConfig($name, $insertionForAssetic);
                        break;
                }
            }
        }
    }
}
