<?php

namespace App\DemoBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * VilleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VilleRepository extends EntityRepository
{
    public function getVillesWhere($id)
    {
        $qb = $this->createQueryBuilder('v')
                ->where('v.region = :id')
                ->setParameter('id', $id)
                ->orderBy('v.id')
        ;

        return $qb->getQuery()->getResult();
    }
}