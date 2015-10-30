<?php

namespace TechCorp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechCorp\FrontBundle\Entity\Status;
use Doctrine\Common\Util\Debug;

class TimelineController extends Controller
{
    public function timelineAction()
    {
    	$em = $this->getDoctrine()->getManager();
        $deleted = false;
        $Statuses = $em->getRepository('TechCorpFrontBundle:Status')->getStatusesAndUsers($deleted)->getResult();

        return $this->render('TechCorpFrontBundle:Timeline:timeline.html.twig', array('Statuses' => $Statuses));
    }


    public function userTimelineAction($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('TechCorpFrontBundle:User')->findOneById($userId);

        if(!$user){
            $this->createNotfoundException("l'utilisateur n'a pas été trouvé.");
        }
        $Statuses = $em->getRepository('TechCorpFrontBundle:Status')->getUserTimeline($user)->getResult();

        return $this->render('TechCorpFrontBundle:Timeline:user_timeline.html.twig', array('Statuses' => $Statuses,
                                                                                           'user' => $user));
    }


    public function friendsTimelineAction($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('TechCorpFrontBundle:User')->findOneById($userId);

        if(!$user){
            $this->createNotfoundException("l'utilisateur n'a pas été trouvé.");
        }
        $Statuses = $em->getRepository('TechCorpFrontBundle:Status')->getFriendsTimeline($user)->getResult();

        return $this->render('TechCorpFrontBundle:Timeline:friends_timeline.html.twig', array('Statuses' => $Statuses,
                                                                                              'user' => $user));
    }

}
