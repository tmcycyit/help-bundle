<?php

namespace Yit\HelpBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    /**
     * This function is used to get plan with relations
     *
     * @param $slug
     * @return array
     */
    public function findAllData($slug)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT art, category
                           FROM YitHelpBundle:Article art
                           LEFT JOIN art.category category
                           LEFT JOIN art.image img
                           WHERE art.slug = :slug
            ")
            ->setParameter('slug', $slug)
            ->getResult();
    }
}