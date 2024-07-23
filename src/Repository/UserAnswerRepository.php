<?php

namespace App\Repository;

use App\Entity\UserAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<UserAnswer>
 */
class UserAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, UserAnswer::class);
        $this->entityManager = $entityManager;
    }

    public function saveUserAnswer(array $questionSeries): void
    {
        $userAnswer = new UserAnswer();
        $userAnswer->setQuestionSeries($questionSeries);

        $this->entityManager->persist($userAnswer);
        $this->entityManager->flush();
    }
}
