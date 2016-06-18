<?php

namespace DiplomBundle\Controller;

use DiplomBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
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
        $data = $request->request->all();
        $event = new Event();
        $event->setName($data['name']);
        $event->setDateStart(new \DateTime($data['datestart']));
        $event->setDateEnd(new \DateTime($data['dateend']));
        $event->setClass($data['class']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();
        return $this->redirect($this->generateUrl('diplom_default_index'));
    }
    /**
     * @Route("/remove/")
     */
    public function removeAction($id){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('DiplomBundle:Event')->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirect($this->generateUrl('diplom_default_index'));
    }
}
