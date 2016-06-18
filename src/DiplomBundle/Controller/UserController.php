<?php

namespace DiplomBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Finder;

/**
 * @Route("/user")
 */
class UserController extends Controller
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
            $images[$file->getRelativePathname()] = 'img/users_pic/' . $file->getRelativePathname();
        }

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('DiplomBundle:User')->findBy([], null, 100);

        return $this->render("@Diplom/user/user.html.twig", [
            'images' => $images,
            'users'  => $users
        ]);
    }
}
