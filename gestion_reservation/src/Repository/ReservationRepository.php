<?php
// src/Repository/ReservationRepository.php
namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    // Méthode pour vérifier l'unicité de la plage horaire pour une date donnée
    public function isTimeSlotUnique(\DateTime $date, string $timeSlot): bool
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->andWhere('r.date = :date')
            ->andWhere('r.timeSlot = :timeSlot')
            ->setParameter('date', $date->format('Y-m-d')) // Comparer uniquement la date sans l'heure
            ->setParameter('timeSlot', $timeSlot)
            ->getQuery();

        return $queryBuilder->getResult() === [];
    }
}
