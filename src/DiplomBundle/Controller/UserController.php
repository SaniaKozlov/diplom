<?php

namespace DiplomBundle\Controller;

use DiplomBundle\Entity\User;
use DiplomBundle\Exception\WrongDateException;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user.list")
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

    /**
     * @Route("/add", name="user.add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request) {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $repo = $em->getRepository('DiplomBundle:User');
        $data = $request->request->all();
        
        $user = $repo->findByEmail($data['email']);
        if ($user !== null) {
            $this->get('session')->getFlashBag()->add('error', 'Користувач з таким email вже існує');
            return $this->redirectToRoute('user.list');
        }

        $user = $repo->findByLogin($data['login']);
        if ($user !== null) {
            $this->get('session')->getFlashBag()->add('error', 'Користувач з таким логіном вже існує');
            return $this->redirectToRoute('user.list');
        }
        
        $user = new User();
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $user->fillFormData($data, $encoder);

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('user.list');
    }

    /**
     * @Route("/remove/{id}", name="user.remove")
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function remove(Request $request, $id) {
        $em = $this->get('doctrine.orm.default_entity_manager');

        $user = $em->find('DiplomBundle:User', $id);
        if ($user === null) {
            $this->get('session')->getFlashBag()->add('error', 'Користувача не знайдено');
            return $this->redirectToRoute('user.list');
        }

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('user.list');
    }

    /**
     * @Route("/edit/{id}", name="user.edit.get")
     * @Method({"GET"})
     * @param Request $request
     * @param integer $id
     * @return JsonResponse|Response
     */
    public function editGET(Request $request, $id) {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $user = $em->find('DiplomBundle:User', $id);
        if ($user === null) {
            $this->get('session')->getFlashBag()->add('error', 'Користувача не знайдено');
            return $this->redirectToRoute('user.list');
        }

        return new JsonResponse(['user' => $user->toArray()]);
    }

    /**
     * @Route("/edit/{id}", name="user.edit.save")
     * @Method({"POST"})
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function editPOST(Request $request, $id) {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $user = $em->find('DiplomBundle:User', $id);
        if ($user === null) {
            $this->get('session')->getFlashBag()->add('error', 'Користувача не знайдено');
            return $this->redirectToRoute('user.list');
        }

        $data = $request->request->all();
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $user->fillFormData($data, $encoder);

        $em->persist($user);
        $em->flush();
        
        return $this->redirectToRoute('user.list');
    }
}
