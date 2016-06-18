<?php

namespace DiplomBundle\Controller;

use DiplomBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/client")
 */
class ClientController extends Controller
{
    /**
     * @Route("/")
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
     */
    public function addAction(Request $request){
        $data = $request->query->all();
        $client = new Client();
        $client->setName($data['name'].' '.$data['lastname']);
        $client->setCreateed(new \DateTime('now'));
        $client->setUpdated(new \DateTime('now'));
        $client->setEmail($data['email']);
        $client->setPhone($data['ipn']);
        $client->setAddress($data['birth']);
        $client->setImage($data['image']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($client);
        $em->flush();
        return $this->redirect($this->generateUrl('diplom_client_index'));
    }

    /**
     * @Route("/edit/{id}")
     */
    public function editAction($id){

    }

    /**
     * @Route("/remove/{id}")
     */
    public function removeAction($id){
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('DiplomBundle:Client')->find($id);
        $em->remove($client);
        $em->flush();
    }

    /**
     * @Route("/info/{id}")
     */
    public function infoAction($id){
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('DiplomBundle:Client')->find($id);
        return $this->render('@Diplom/client/index.html.twig', array('client' => $client));
    }
}
