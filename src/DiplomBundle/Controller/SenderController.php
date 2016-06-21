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
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $mails = $em->getRepository('DiplomBundle:Mail')->findBy([],['created' => 'DESC']);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $mails, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('@Diplom/sender/sender.html.twig', ['mails' => $pagination]);
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

    /**
     * @Route("/long", name="sender.long")
     */
    public function longSendAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('DiplomBundle:User')->findAll();
        $time_start = microtime(true);
        foreach ($users as $user) {
            $mail = new Mail();
            $mail->setCreated(new \DateTime('now'));
            $mail->setMessage('test');
            $mail->setUserid(1);
            $mail->setTheme('test theme');
            $mail->setReciver($user->getUsername());
            $em->persist($mail);
            sleep(2);
            $em->flush();
            $this->get('diplom.logger')->logEvent(
                'Розсилка',
                sprintf('Користувач %s виконав розсилання для %s', $this->getUser()->getUsername(), $user->getUsername())
            );
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        return $this->render('@Diplom/sender/time.html.twig', ['s' => 'прямим виконанням', 'time' => round($time*1000,4), 'count' => count($users)]);
    }

    /**
     * @Route("/quiq", name="sender.quiq")
     */
    public function quiqSendAction(){
        $time_start = microtime(true);
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('DiplomBundle:User')->findAll();
        foreach ($users as $user) {
            $mail = new Mail();
            $mail->setCreated(new \DateTime('now'));
            $mail->setMessage('test');
            $mail->setUserid(1);
            $mail->setTheme('test theme');
            $mail->setReciver($user->getUsername());
            $em->persist($mail);
            $em->flush();
            $this->get('diplom.logger')->logEvent(
                'Розсилка',
                sprintf('Користувач %s виконав розсилання для %s', $this->getUser()->getUsername(), $user->getUsername())
            );
        }
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        return $this->render('@Diplom/sender/time.html.twig', ['s' => 'паралельним виконанням', 'time' => round($time*1000,4), 'count' => count($users)]);
    }
}
