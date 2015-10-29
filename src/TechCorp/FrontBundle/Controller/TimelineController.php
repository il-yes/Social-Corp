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

}
