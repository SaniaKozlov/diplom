<?php

namespace DiplomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * @Route("/event")
 */
class EventController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
