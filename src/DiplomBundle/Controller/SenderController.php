<?php

namespace DiplomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * @Route("/sender")
 */
class SenderController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        
        return $this->render('@Diplom/sender/sender.html.twig');
    }
}
