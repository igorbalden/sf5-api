<?php

namespace App\Tests\Repository;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
// use Doctrine\Persistence\ManagerRegistry;
// use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class UsersRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function tearDown(): void {
        parent::tearDown();
        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }    

    // public function store_user(Users $user): string {
    //   // $mgr = $this->getEntityManager();
    //   $this->_em->persist($user);
    //   // $this->_em->flush($user);
    //   return $user->getEmail();
    // }

    // /**
    //  * @return Users[] Returns an array of Users objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Users
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
