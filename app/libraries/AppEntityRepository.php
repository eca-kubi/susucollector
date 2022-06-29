<?php

use Doctrine\ORM\EntityRepository;

 abstract class AppEntityRepository extends EntityRepository
{
    public function __construct()
    {
        $em = GetEntityManager();
        $class = $em->getClassMetadata($this->getEntityClassName());
        parent::__construct($em, $class);
    }

     abstract function findOneByCriteria(array $criteria, ?array $orderBy = null);

     abstract function findOneById(int|string $id);

     abstract function findByCriteria(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null);

     abstract function getEntityClassName(): string;

     abstract static function instance();
 }