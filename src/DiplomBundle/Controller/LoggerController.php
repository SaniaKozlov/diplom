<?php

namespace DiplomBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/logger")
 */
class LoggerController extends Controller
{
    /**
     * @Route("/", name="logger.show")
     */
    public function getClients(Request $request) {
        $em = $this->get('doctrine.orm.default_entity_manager');

        $logs = $em->getRepository('DiplomBundle:Log')->findBy([],['created'=>'DESC']);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $logs, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('@Diplom/log/log.html.twig', [
            'logs' => $pagination
        ]);
    }
}
