<?php

namespace TechCorp\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use TechCorp\FrontBundle\Entity\User;
use TechCorp\FrontBundle\Entity\Status;

class LoadStatusData extends AbstractFixture implements OrderedFixtureInterface
{

	const MAX_NB_STATUS = 50;

  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
	public function load(ObjectManager $manager)
	{



		// Methode automatisé : utilisation de la librairie Faker
		$faker = \Faker\Factory::create();

		for ($i=0; $i<self::MAX_NB_STATUS; ++$i)
		{
			$status = new Status();
			$status -> setContent($faker->text(250));
			$status -> setDeleted($faker->boolean);
			$status -> setCreatedAt(new \DateTime());

			$user = $this->getReference("user".rand(0,9));
			$status -> setUser($user);
		
			// On la persiste
	  		$manager->persist($status);
	  		$this->addReference('status'.$i, $status);
		}

		// On déclenche l'enregistrement de touts les status
		$manager->flush();

	}


	public function getOrder(){
		return 2;
	}
}