<?php

namespace TechCorp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function manageFriendAction($friendId, $addFriend = true)
    {
    	$em = $this->getDoctrine()->getManager();
    	$friend = $em->getRepository('TechCorpFrontBundle:User')
    				 ->findOneById($friendId);
    	$authenticatedUser = $this->get('security.context')->getToken()->getUser();

    	if(!$friend){
    		return new response("Utilisateur inexistant", 400);
    	}
    	if(!$authenticatedUser){
    		return new response("Authentification nécessaire inexistant", 401);
    	}
    	if($addFriend){
    		if(!$authenticatedUser->hasFriend($friend)){
    			$authenticatedUser->addFriend($friend);
    		}
    	}
    	else{
    		$authenticatedUser->removeFriend($friend);
    	}

    	$em->persist($authenticatedUser);
    	$em->flush();
    	return new response("ok");

    }

    public function addFriendAction($friendId){
    	return $this->manageFriendAction($friendId, true);
    }

    public function removeFriendAction($friendId){
    	return $this->manageFriendAction($friendId, false);
    }
}