<?php

use Doctrine\Common\Collections\Collection;


/**
 * TransactionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TransactionRepository extends AppEntityRepository
{
    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return array|Transaction[]
     */
    public function findByCriteria(array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneByCriteria(array $criteria, ?array $orderBy = null): Transaction|null
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    public function findOneById(int|string $id): Transaction|null
    {
        return parent::find($id);
    }

    public function getEntityClassName(): string
    {
        return 'Transaction';
    }

    /**
     * @param int|string $accountId
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @return array|null|float|int|string|Transaction[]
     * @throws Exception
     */
    public function getFromStartDateToEndDate(int|string $accountId, DateTime $startDate, DateTime $endDate): float|array|int|string|null
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t')
            ->from($this->getEntityClassName(), 't')
            ->where('t.account_id = :aid')
            ->setParameter('aid', $accountId)
            ->add('where', $qb->expr()->between(
                't.date_created',
                ':from',
                ':to'
            ))
            ->setParameters(array('from' => $startDate, 'to' => new DateTime($endDate->format('Y-m-d'. '23:59:59')) )); // endDate is formatted to cover the last second of the day.
        $q = $qb->getQuery();
        return $q->getResult();
    }

    /**
     * @throws Exception
     */
    public function getOpeningInitialBalance(int|string $accountId, DateTime $startDate, DateTime $endDate)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t.initial_balance')
            ->from($this->getEntityClassName(), 't')
            ->where('t.account_id = :aid')
            ->setParameter('aid', $accountId)
            ->add('where', $qb->expr()->between(
                't.date_created',
                ':from',
                ':to'
            ))
            ->setParameters(array('from' => $startDate, 'to' => new DateTime($endDate->format('Y-m-d'. '23:59:59')) )) // endDate is formatted to cover the last second of the day.
            ->orderBy('t.date_created', 'ASC')
            ->setMaxResults(1);
        $q = $qb->getQuery();
        return $q->getSingleScalarResult();
    }

    /**
     * @throws Exception
     */
    public function getClosingFinalBalance(int|string $accountId, DateTime $startDate, DateTime $endDate)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('t.final_balance')
            ->from($this->getEntityClassName(), 't')
            ->where('t.account_id = :aid')
            ->setParameter('aid', $accountId)
            ->add('where', $qb->expr()->between(
                't.date_created',
                ':from',
                ':to'
            ))
            ->setParameters(array('from' => $startDate, 'to' => new DateTime($endDate->format('Y-m-d'. '23:59:59')) )) // endDate is formatted to cover the last second of the day.
            ->orderBy('t.date_created', 'DESC')
            ->setMaxResults(1);
        $q = $qb->getQuery();
        return $q->getSingleScalarResult();
    }

    public static function instance(): TransactionRepository
    {
        return new self();
    }
}
