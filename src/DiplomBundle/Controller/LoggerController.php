<?php

namespace DiplomBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
            ->select('u')
            ->from('DiplomBundle:Log', 'u')->addOrderBy('u.created','DESC')
            ->getQuery();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('@Diplom/log/log.html.twig', [
            'logs' => $pagination
        ]);
    }
}
