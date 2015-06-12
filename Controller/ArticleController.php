<?php

namespace Yit\HelpBundle\Controller;

use Yit\HelpBundle\Entity\Article;
use Yit\HelpBundle\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use JMS\SecurityExtraBundle\Annotation\Secure;
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
     * @Template()"
     * @Secure(roles="ROLE_USER")
     */
    public function homeAction()
    {
        if ($this->container->getParameter('yit_help.help_secure'))
        {
            // get current user
            $user = $this->getUser();
            if(!$user)
            {
                throw $this->createNotFoundException("User Not Found, You must authenticate first ");
            }
        }

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('YitHelpBundle:Category')->findAllData();
        if (!$categories) {
            throw $this->createNotFoundException('No category found');
        }
        return array('categories' => $categories);
    }

} 