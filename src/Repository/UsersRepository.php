<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function store(Users $user): string {
      // $mgr = $this->getEntityManager();
      $this->_em->persist($user);
      $this->_em->flush();
      return $user->getEmail();
    }

    /**
     * Don't need to use custom sql for insert, update, delete
     */
    public function db_selectById(int $id) {
      $conn = $this->_em->getConnection();
      $stmt = $conn->prepare("SELECT name FROM users WHERE id= :id");
      $stmt->execute(['id' => $id]);
      return $stmt->fetchOne();
    }

    public function authenticate(Users $user): ?Users {
      $u_found = $this->findOneByEmail($user->getEmail());
      if (!$u_found) {
        return null;
      }
      if (!password_verify($user->getPassword(), $u_found->getPassword())) {
        return null;
      }
      return $u_found;
    }

    public function findOneByEmail($value): ?Users {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getAll(): array {
        return $this->createQueryBuilder('u')
            ->select('u.id, u.name, u.email')
            ->getQuery()
            ->getArrayResult()
        ;
    }

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
    
}
