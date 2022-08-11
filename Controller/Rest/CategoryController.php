<?php

namespace Tmcycyit\HelpBundle\Controller\Rest;

use Tmcycyit\HelpBundle\Entity\Category;
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
 * @Rest\RouteResource("Category")
 * @Rest\Prefix("/api/help")
 * @Rest\NamePrefix("rest_")
 */
class CategoryController extends FOSRestController
{
    /**
     *
     * This function is used to get a Category and its Articles by given id.
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Category",
     *  description="This function is used to get a Category and its Articles by given id.",
     *  statusCodes={
     *         200="Returned when successful",
     *         403="Not Allowed",
     *         404="Returned when the Category is not found"
     *     }
     * )
     *
     * @Rest\View(serializerGroups={"category", "category_article", "article"})
     * @ParamConverter("category", class="TmcycyitHelpBundle:Category")
     */
    public function getAction(Category $category){
        return $category;
    }

    /**
     *
     * This function is used to get a Categories and their Articles by ids.
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Category",
     *  description="This function is used to get a Categories and their Articles.",
     *  statusCodes={
     *         200="Returned when successful",
     *         403="Not Allowed"
     *     }
     * )
     *
     * @Rest\View(serializerGroups={"category", "category_article", "article"})
     */
    public function getAllAction(){

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('TmcycyitHelpBundle:Category')->findAllData();

        return $categories;
    }

}