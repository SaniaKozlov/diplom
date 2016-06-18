<?php

namespace DiplomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('', array('name' => $name));
    }
}
