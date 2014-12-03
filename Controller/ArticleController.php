<?php

namespace Yit\HelpBundle\Controller;

use Yit\HelpBundle\Entity\Article;
use Yit\HelpBundle\Entity\Category;
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
     * @Template()"
     */
    public function homeAction()
    {
        $user = $this->getUser(); // get current user
        if(!$user)
        {
            throw $this->createNotFoundException("User Not Found, You must authenticate first ");
        }

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('YitHelpBundle:Category')->findAllData();
        if (!$categories) {
            throw $this->createNotFoundException('No category found');
        }
        return array('categories' => $categories);
    }

    /**
     * @Route("/help/article/{slug}", name="my_terms")
     * @Template()
     */
    public function showAction($slug)
    {
        $user = $this->getUser(); // get current user
        if(!$user)
        {
            throw $this->createNotFoundException("User Not Found, You must authenticate first ");
        }

        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('YitHelpBundle:Article')->findAllData($slug);
        if (!$articles) {
            throw $this->createNotFoundException('No article found for category');
        }
        $categories = $em->getRepository('YitHelpBundle:Category')->findAllData();
        return array('articles' => $articles, 'categories' => $categories);
    }

} 