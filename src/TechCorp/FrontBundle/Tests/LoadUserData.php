<?php

namespace TechCorp\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use TechCorp\FrontBundle\Entity\User;
use TechCorp\FrontBundle\Entity\Status;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{

	const MAX_NB_USERS = 10;

	public function load(ObjectManager $manager)
	{
		
		$faker = \Faker\Factory::create();

		for ($i=0; $i<self::MAX_NB_USERS; ++$i)
		{
			$user = new User();
			$user->setUserName($faker->username);

	  		$manager->persist($user);

	  		$this->addReference("user".$i, $user);
		}

		$manager->flush();

	}


	public function getOrder(){
		return 1;
	}
}


