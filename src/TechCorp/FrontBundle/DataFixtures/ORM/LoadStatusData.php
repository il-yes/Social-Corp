<?php

namespace TechCorp\FrontBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use TechCorp\FrontBundle\Entity\Status;

class LoadStatusData implements FixtureInterface
{

	const MAX_NB_STATUS = 50;

  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
	public function load(ObjectManager $manager)
	{
		/*
		// Methode manuelle :
		// 1er status factice generé
		$status = new status();
		$status -> setContent('Phasellus commodo viverra velit quis placerat. Suspendisse volutpat nibh vitae massa sodales, eu imperdiet ipsum pulvinar. Aliquam massa risus, tincidunt non risus sed, porta dapibus odio. Quisque faucibus elementum felis. Donec eu risus eleifend, laoreet dui eget, maximus tellus. Ut sodales elementum risus, nec tincidunt nisl dictum sit amet. Integer lobortis lobortis est, ut mollis nisl vestibulum id. Vestibulum sed finibus tortor, a fringilla purus.');
		$status -> setDeleted(false);
		$status -> setCreatedAt(new \DateTime());

	   	// On la persiste
	  	$manager->persist($status);

	  	// 2nd status factice generé
	  	$status2 = new status();
		$status2 -> setContent('Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut et nisl iaculis, tincidunt ante sed, tincidunt lorem. Sed lacinia augue nec ligula blandit, eu convallis nibh pharetra. Aenean sed aliquam lacus, ut dapibus mi. Morbi egestas pharetra elementum.');
		$status2 -> setDeleted(true);
		$status2 -> setCreatedAt(new \DateTime());

		// On la persiste
	  	$manager->persist($status2);
		*/


		// Methode automatisé : utilisation de la librairie Faker
		$faker = \Faker\Factory::create();

		for ($i=0; $i<self::MAX_NB_STATUS; ++$i)
		{
			$status = new status();
			$status -> setContent($faker->text(250));
			$status -> setDeleted($faker->boolean);
			$status -> setCreatedAt(new \DateTime());
		
			// On la persiste
	  		$manager->persist($status);
		}





	// On déclenche l'enregistrement de touts les status
	$manager->flush();

	}
}