<?php

namespace TechCorp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TechCorp\FrontBundle\Entity\Status;
use TechCorp\FrontBundle\Form\StatusType;
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

        // Création formulaire
        $authenticatedUser = $this->get('security.context')->getToken()->getUser();
        $status = new Status();
        $status->setDeleted(false);
        $status->setCreatedAt(new \DateTime());
        $status->setUser($authenticatedUser);

        $form = $this->createForm(new StatusType(), $status);
        $request = $this->getRequest();

        $form->handleRequest($request);
        // Traitement formulaire
        if($authenticatedUser && $form->isValid())
        {
            $em->persist($status);
            $em->flush();
            $this->redirect($this->generateUrl(
                                    'tech_corp_front_user_timeline', array('userId' => $authenticatedUser->getId())
                                    )
                            );
        }

        // Récuperer les status
        $Statuses = $em->getRepository('TechCorpFrontBundle:Status')
                       ->getUserTimeline($user)->getResult();


        return $this->render('TechCorpFrontBundle:Timeline:user_timeline.html.twig', array('Statuses' => $Statuses,
                                                                                           'user' => $user,
                                                                                           'form' => $form->createView(),
                                                                                           ));
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


    public function usersListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('TechCorpFrontBundle:User')->findAll();

        return $this->render('TechCorpFrontBundle:Timeline:users_list.html.twig', array('users' => $users));
    }

}
