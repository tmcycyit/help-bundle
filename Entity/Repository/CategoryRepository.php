<?php

namespace Yit\HelpBundle\Entity\Repository;


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
            ->createQuery("SELECT art, category
                           FROM YitHelpBundle:Article art
                           LEFT JOIN art.category category
            ")
            ->getResult();
    }

} 