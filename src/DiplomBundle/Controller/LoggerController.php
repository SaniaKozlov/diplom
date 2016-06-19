<?php

namespace DiplomBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/logger")
 */
class LoggerController extends Controller
{
    /**
     * @Route("/clients")
     */
    public function getClients()
    {
        // TODO: доклепати
        // FIXME: доклепати
    }
}
