<?php
namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\UserAccount;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends Controller
{
    /**
     * @Route("/account", name="account")
     */
    public function accountAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $username = $this->getUser()->getUsername();
        $currentUser = $em->getRepository(UserAccount::class)->findOneBy(['username' => $username]);

        if (!$currentUser) {
            throw $this->createNotFoundException(
                'User is not logged in!'
            );
        }

        if ($request->isMethod('POST')) {
            $currentUser->setUsername($request->request->get('username'));
            $currentUser->setEmail($request->request->get('email'));

            $newPassword = $request->request->get('password');
            $repeatedPassword = $request->request->get('password_repeat');
            if(!empty($newPassword) && $newPassword === $repeatedPassword)
            {
                $currentUser->setPlainPassword($newPassword);
                $encodedPassword = $passwordEncoder->encodePassword($currentUser, $currentUser->getPlainPassword());
                $currentUser->setPassword($encodedPassword);
            }

            $em->flush();
        }

        return $this->render('account/main.html.twig', [ 
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}