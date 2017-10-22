<?php
namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\UserAccount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AuthController extends Controller
{

    /**
     * @Route("/auth")
     * @Method({"GET"})
     */
    public function signInShowAction(Request $request)
    {
        return $this->render('auth/login.html.twig', array(
            'register_link' => 'localhost/register',
        ));
    }

    /**
     * @Route("/auth")
     * @Method({"POST"})
     */
    public function signInAction(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(UserAccount::class);

        $registredUser = $repository->findOneBy(array('email' => $email, 'password' => $password));

        if ($registredUser === null) {
                return $this->render('auth/login.html.twig', array(
            'register_link' => 'localhost/register', 'incorrect' => true
            ));
        }
        else {
            return $this->render('auth/signed.html.twig', array(
                'nickname' => $registredUser->getNickname()
            ));
        }

        return $this->render('auth/login.html.twig', array(
            'register_link' => 'localhost/register',
        ));
    }

    /**
     * @Route("/register")
     * @Method({"GET"})
     */
    public function showRegistrationAction(Request $request)
    {
        return $this->render('auth/register.html.twig', array(
            'signin_link' => 'localhost/auth',
        ));
    }

        /**
     * @Route("/register")
     * @Method({"POST"})
     */
    public function registrationAction(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $nickname = $request->get('nickname');

        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(UserAccount::class);
        $isUnkownUser = !$repository->findOneBy(array('email' => $email));

        if ($isUnkownUser) {

            $newUser = new UserAccount();
            $newUser->setEmail($email);
            $newUser->setNickname($nickname);
            $newUser->setPassword($password);

            $entityManager->persist($newUser);
            $entityManager->flush();

            return $this->redirectToRoute('auth');
        }
        else {
            return $this->render('auth/register.html.twig', array(
                'signin_link' => 'localhost/auth', 'incorrect' => true
            ));
        }
    }
}