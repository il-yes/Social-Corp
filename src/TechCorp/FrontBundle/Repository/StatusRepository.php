<?php

namespace TechCorp\FrontBundle\Repository;

use Doctrine\ORM\EntityRepository;
/**
 * StatusRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StatusRepository extends EntityRepository
{
/*
	// Requetes DQL
	public function getStatusesAndUsers()
	{
		return $this->_em->createQuery('
			SELECT s, u
			FROM TechCorpFrontBundle:Status s
			JOIN s.user u
			ORDER BY s.createdAt DESC
			');
	}
*/

	// Requetes QueryBuilder
	public function getStatusesAndUsers()
	{
		return $this->_em->createQueryBuilder()
			->select('s', 'u')
			->from('TechCorpFrontBundle:Status', 's') 
			->join('s.user', 'u') 
			->orderBy('s.createdAt', 'DESC')
			->getQuery() 
			;
	}
}
