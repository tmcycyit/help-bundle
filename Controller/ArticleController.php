<?php

namespace Tmcycyit\HelpBundle\Controller;

use Tmcycyit\HelpBundle\Entity\Article;
use Tmcycyit\HelpBundle\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 *
 */
class ArticleController extends Controller
{

    /**
     * @Route("/help", name="yit_content_homepage")
     * @Route("/help/{categoryName}/{articleId}",requirements={ "articleId": "\d+" })
     * @Template("TmcycyitHelpBundle:Article:home.html.twig")
     *
     */
    public function homeAction()
    {
        if ($this->container->getParameter('tmcycyit_help.help_secure'))
        {
            // get current user
            $user = $this->getUser();
            if(!$user)
            {
                throw $this->createNotFoundException("User Not Found, You must authenticate first ");
            }
        }

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('TmcycyitHelpBundle:Category')->findAllData();
        if (!$categories) {
            throw $this->createNotFoundException('No category found');
        }
        return array('categories' => $categories);
    }

} 