<?php

namespace DiplomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        if($user === null){
            return $this->redirect($this->generateUrl('fos_user_security_login'), 301);
        }
        return $this->render('DiplomBundle:Default:index.html.twig');
    }
}
