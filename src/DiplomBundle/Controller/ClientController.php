<?php

namespace DiplomBundle\Controller;

use DiplomBundle\Entity\Client;
use DiplomBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/client")
 */
class ClientController extends Controller
{
    /**
     * @Route("/")
     * @return Response
     */
    public function indexAction()
    {
        $finder = new Finder();
        $finder->files()->in(realpath($this->get('kernel')->getRootDir() . '/../web/img/users_pic'));
        $images = [];
        foreach ($finder as $file) {
            $images[$file->getRelativePathname()] = 'img/users_pic/'.$file->getRelativePathname();
        }
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('DiplomBundle:Client')->findAll();
        return $this->render('@Diplom/client/index.html.twig', array('clients' => $clients, 'images' => $images));
    }

    /**
     * @Route("/add")
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request){
        /** @var User $myself */
        $myself = $this->getUser();

        $data = $request->query->all();
        $client = new Client();
        $client->setName($data['name'].' '.$data['lastname']);
        $client->setCreateed(new \DateTime('now'));
        $client->setUpdated(new \DateTime('now'));
        $client->setEmail($data['email']);
        $client->setPhone($data['ipn']);
        $client->setAddress($data['birth']);
        $client->setImage($data['image']);
        $client->setBirth(new \DateTime($data['birth']));

        $em = $this->getDoctrine()->getManager();
        $em->persist($client);
        $em->flush();

        $this->get('diplom.logger')->logEvent(
            'Клієнти',
            sprintf('Користувач %s додав клієнта %s', $myself->getUsername(), $client->getName())
        );

        return $this->redirect($this->generateUrl('diplom_client_index'));
    }

    /**
     * @Route("/edit/{id}")
     * @param integer $id
     * @param Request $request
     * @return Response
     */
    public function editAction($id, Request $request){
        if($request->getMethod() == "POST") {
            /** @var User $myself */
            $myself = $this->getUser();
            $data = $request->request->all();
            $em = $this->getDoctrine()->getManager();
            $client = $em->getRepository('DiplomBundle:Client')->find($id);
            $client->setName($data['name'].' '.$data['lastname']);
            $client->setUpdated(new \DateTime('now'));
            $client->setEmail($data['email']);
            $client->setPhone($data['ipn']);
            $client->setAddress($data['birth']);
            $client->setImage($data['image']);
            $client->setBirth(new \DateTime($data['birth']));

            $em->persist($client);
            $em->flush();

            $this->get('diplom.logger')->logEvent(
                'Клієнти',
                sprintf('Користувач %s відредагував клієнта %s', $myself->getUsername(), $client->getName())
            );

            return $this->redirect($this->generateUrl('diplom_client_index'));
        } else {
            $em = $this->getDoctrine()->getManager();
            $client = $em->getRepository('DiplomBundle:Client')->find($id);
            $response = new Response(json_encode(array("result" => $client->toArray())));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

    /**
     * @Route("/remove/{id}")
     * @param integer $id
     * @return Response
     */
    public function removeAction($id){
        /** @var User $myself */
        $myself = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('DiplomBundle:Client')->find($id);

        $clone = clone $client;
        $em->remove($client);
        $em->flush();

        $this->get('diplom.logger')->logEvent(
            'Клієнти',
            sprintf('Користувач %s видалив клієнта %s', $myself->getUsername(), $clone->getName())
        );

        return $this->redirect($this->generateUrl('diplom_client_index'));
    }

    /**
     * @Route("/info/{id}")
     * @param integer $id
     * @return Response
     */
    public function infoAction($id){
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('DiplomBundle:Client')->find($id);
        $response = new Response(json_encode(array("result" => $client->toArray())));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
