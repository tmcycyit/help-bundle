<?php

namespace Yit\HelpBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouteCollection;

class PageRouteExtension extends \Twig_Extension
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'language_params' => new \Twig_Function_Method($this, 'languageParams', array('is_safe' => array('html'))),
        );
    }

    public function languageParams()
    {
        $request = $this->container->get('request');
        $params = $request->attributes->all();

        if (array_key_exists('_route_params', $params)) {
            $params = $params['_route_params'];


            // check param
            $page = $request->get('page', 0);
            if ($page) {
                $params['page'] = $page;
            }
            return $params;
        }

        return array();
    }

    public function getName()
    {
        return 'page_route';
    }

}