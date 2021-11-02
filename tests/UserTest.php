<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use App\Entity\UserProfile;
use App\Entity\Question;
use App\Entity\Comment;
use App\Repository\UserProfileRepository;

class UserTest extends KernelTestCase
{
    
    
    /**
 * @var \Doctrine\ORM\EntityManager
 */
Private $entityManager;



   
    public function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
        ->get('doctrine')
        ->getManager();
    }

//First unit test Make user

    public function testUserCreation(): void
    {

        $userProfile = new UserProfile();

        $userProfile->setName("test name");
        $userProfile->setSurname("test surname");
        $userProfile->setEmail("test@gmail.com");
        $userProfile->setPassword("123456");
        $userProfile->setProfileUrl("pfp.co.za");
        $userProfile->setRep("1000");
        $userProfile->setAccess("0");
        
        $this->assertIsString($userProfile->getName());
        $this->assertIsString($userProfile->getSurname());
        $this->assertIsString($userProfile->getEmail());
        $this->assertIsString($userProfile->getPassword());
        $this->assertIsString($userProfile->getProfileUrl());
        $this->assertIsString($userProfile->getRep());
        $this->assertIsString($userProfile->getAccess());


        $this->entityManager->persist($userProfile);
        $this->entityManager->flush();



    }
//Second unit test to search user by email

       /**
     * @depends testUserCreation
     */
    public function testSearchByEmail(): void
    {

        $userProfile = $this->entityManager
        ->getRepository(UserProfile::class)
        ->findOneBy(['email' => 'test@gmail.com']);

        $this->assertEquals('test name', $userProfile->getName());
        $this->assertEquals('test@gmail.com', $userProfile->getEmail());
        $this->assertEquals('123456', $userProfile->getPassword());

    }

    //Third unit test to search user by Name

       /**
     * @depends testUserCreation
     */
    public function testSearchByName(): void
    {

        $userProfile = $this->entityManager
        ->getRepository(UserProfile::class)
        ->findOneBy(['name' => 'test name']);

        $this->assertEquals('test name', $userProfile->getName());
        $this->assertEquals('test@gmail.com', $userProfile->getEmail());
        $this->assertEquals('123456', $userProfile->getPassword());

    }
    //Third unit test to search user by Surname
           /**
     * @depends testUserCreation
     */
    public function testSearchBySurName(): void
    {

        $userProfile = $this->entityManager
        ->getRepository(UserProfile::class)
        ->findOneBy(['surname' => 'test surname']);

        $this->assertEquals('test name', $userProfile->getName());
        $this->assertEquals('test@gmail.com', $userProfile->getEmail());
        $this->assertEquals('123456', $userProfile->getPassword());

    }

    










    protected function teardown(): void{
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }

}
