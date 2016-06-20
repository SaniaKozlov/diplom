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
     * @Route("/", name="logger.show")
     */
    public function getClients() {
        $em = $this->get('doctrine.orm.default_entity_manager');

        $logs = $em->getRepository('DiplomBundle:Log')->findBy([],['created'=>'DESC']);

        return $this->render('@Diplom/log/log.html.twig', [
            'logs' => $logs
        ]);
    }
}
