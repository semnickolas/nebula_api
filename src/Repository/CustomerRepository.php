<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    /**
     * @param string $email
     * @param string $name
     * @return Customer
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function getCustomer(string $email, string $name) : Customer
    {
        $customer = $this->findOneBy(['email' => $email]);
        if ($customer === null) {
            $customer = (new Customer())->setEmail($email)->setName($name);
            $this->save($customer);
        }

        return $customer;
    }

    /**
     * @param Customer $customer
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Customer $customer) : void
    {
        $this->_em->persist($customer);
        $this->_em->flush();
    }
}
