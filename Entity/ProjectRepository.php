<?php

namespace GS\VoteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends EntityRepository
{

    public function getProjectById( $user)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->where('p.valid = 1')
            ->orWhere('p.utilisateur = :utilisateur')
            ->setParameter('utilisateur', $user)
            ;

        $projects = $qb->getQuery()
            ->getResult()
        ;

        return $projects;
    }
}
