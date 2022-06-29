<?php
interface EntityRepositoryInterface {
   function findOneByCriteria(array $criteria, ?array $orderBy = null);
   function findOneById(int|string $id);
   function findByCriteria(array $criteria, ?array $orderBy = null, int|null $limit = null, int|null $offset=null);
   function getEntityClassName():string;
   static function instance();
}