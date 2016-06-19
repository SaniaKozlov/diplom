<?php

namespace DiplomBundle\Controller;

use DiplomBundle\Entity\Event;
use DiplomBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/event")
 */
class EventController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events_ = $em->getRepository('DiplomBundle:Event')->findAll();
        $events = [];
        foreach ($events_ as $event) {
            array_push($events, $event->toArray());
        }
        $response = new Response(json_encode(array("result" => $events)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    /**
     * @Route("/add")
     */
    public function addAction(Request $request){
        /** @var User $user */
        $user = $this->getUser();

        $data = $request->request->all();
        $event = new Event();
        $event->setName($data['name']);
        $event->setDateStart(new \DateTime($data['datestart']));
        $event->setDateEnd(new \DateTime($data['dateend']));
        $event->setClass($data['class']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();

        $this->get('diplom.logger')->logEvent(
            'Події',
            sprintf('Користувач %s додав нову подію %s', $user->getUsername(), $data['name'])
        );

        return $this->redirect($this->generateUrl('diplom_default_index'));
    }
    /**
     * @Route("/remove/")
     */
    public function removeAction($id){
        /** @var User $user */
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('DiplomBundle:Event')->find($id);

        $clone = clone $event;
        $em->remove($event);
        $em->flush();

        $this->get('diplom.logger')->logEvent(
            'Події',
            sprintf('Користувач %s видалив подію %s', $user->getUsername(), $clone->getName())
        );

        return $this->redirect($this->generateUrl('diplom_default_index'));
    }
}
