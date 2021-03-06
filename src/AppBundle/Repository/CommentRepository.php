<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Comment;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPaginationOptions()
    {
        return [
            'defaultSortFieldName' => 'c.createdAt',
            'defaultSortDirection' => 'desc',
            'sortFieldWhitelist' => ['c.id', 'c.name', 'c.email', 'c.createdAt'],
        ];
    }

    /**
     * @param Comment $comment
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store($comment)
    {
        $em = $this->getEntityManager();
        $em->persist($comment);
        $em->flush();
    }
}
