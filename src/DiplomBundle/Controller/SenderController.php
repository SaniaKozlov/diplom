<?php

namespace DiplomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use DiplomBundle\Entity\Mail;

/**
 * @Route("/sender")
 */
class SenderController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $mails = $em->getRepository('DiplomBundle:Mail')->findBy([],['created' => 'DESC']);
        return $this->render('@Diplom/sender/sender.html.twig', ['mails' => $mails]);
    }

    /**
     * @Route("/send", name="sender.send")
     */
    public function sendAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $request->request->all();
        $user = $em->getRepository('DiplomBundle:User')->findBy(['username' => $data['from']]);
        if(count($user)>0){
            $user_id = $user[0]->getId();
        } else {
            $user_id = 0;
        }
        if($data['to'] == 'clients'){
            $str = 'клієнтів';
        } else {
            $str = 'робітників';
        }
        $mail = new Mail();
        $mail->setCreated(new \DateTime('now'));
        $mail->setMessage($data['messsage']);
        $mail->setUserid($user_id);
        $mail->setTheme($data['theme']);
        $mail->setReciver($data['to']);
        $em->persist($mail);
        $em->flush();
        $this->get('diplom.logger')->logEvent(
            'Розсилка',
            sprintf('Користувач %s виконав розсилання для %s', $this->getUser()->getUsername(), $str)
        );
        return $this->redirect('/sender', 301);
    }
}
