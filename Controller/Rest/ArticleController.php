<?php

namespace Yit\HelpBundle\Controller\Rest;

use Yit\HelpBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\ORM\Mapping as ORM;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;

/**
 * @Rest\RouteResource("Article")
 * @Rest\Prefix("/api")
 * @Rest\NamePrefix("rest_")
 */
class ArticleController extends FOSRestController
{
    /**
     *
     * This function is used to get a Article by given id.
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Article",
     *  description="This function is used to get a Article by given id.",
     *  statusCodes={
     *         200="Returned when successful",
     *         403="Not Allowed",
     *         404="Returned when the Category is not found"
     *     }
     * )
     *
     * @Rest\View(serializerGroups={"article"})
     * @ParamConverter("article", class="YitHelpBundle:Article")
     */
    public function getAction(Article $article){
        return $article;
    }

    /**
     *
     * This function is used to get a Articles by given id.
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Article",
     *  description="This function is used to get a Articles by given id.",
     *  statusCodes={
     *         200="Returned when successful",
     *         403="Not Allowed",
     *         404="Returned when the Category is not found"
     *     }
     * )
     *
     * @Rest\View(serializerGroups={"article"})
     */
    public function getAllAction(){

        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('YitHelpBundle:Article')->findAll();

        return $articles;
    }

}