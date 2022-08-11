<?php

namespace Tmcycyit\HelpBundle\Entity\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class CategoryRepository extends EntityRepository
{

    /**
     * This function is used to get plan with relations
     *
     * @return array
     */
    public function findAllData()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT category, art
                           FROM TmcycyitHelpBundle:Category category
                           LEFT JOIN category.article art
                           ORDER BY category.position ASC
            ")
            ->getResult();
    }

} 