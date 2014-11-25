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
     * This function is used to get a Article's content by given id.
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Article",
     *  description="This function is used to get a Article's content by given id.",
     *  statusCodes={
     *         200="Returned when successful",
     *         403="Not Allowed",
     *         404="Returned when the Article is not found"
     *     }
     * )
     *
     * @Rest\View(serializerGroups={"content"})
     * @ParamConverter("article", class="YitHelpBundle:Article")
     */
    public function getAction(Article $article){
        return $article;
    }

    /**
     *
     * This function is used to get all Articles.
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Article",
     *  description="This function is used to get all Articles.",
     *  statusCodes={
     *         200="Returned when successful",
     *         403="Not Allowed"
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