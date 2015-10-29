<?php

namespace TechCorp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechCorp\FrontBundle\Entity\Status;

class TimelineController extends Controller
{
    public function timelineAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$Statuses = $em->getRepository('TechCorpFrontBundle:Status')->findAll();

        return $this->render('TechCorpFrontBundle:Timeline:timeline.html.twig', array('Statuses' => $Statuses));
    }


    public function userTimelineAction($userId)
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $em->getRepository('TechCorpFrontBundle:User')->findOneById($userId);

    	if(!$user){
    		$this->createNotfoundException("l'utilisateur n'a pas été trouvé.");
    	}
    	$Statuses = $em->getRepository('TechCorpFrontBundle:Status')->findBy(array('user' =>$user,
																				   'deleted' => false));

        return $this->render('TechCorpFrontBundle:Timeline:user_timeline.html.twig', array('Statuses' => $Statuses,
        																				   'user' => $user));
    }

}
