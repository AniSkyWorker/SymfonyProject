<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Guitar;
use AppBundle\Entity\UserAccount;
use Symfony\Component\HttpFoundation\Response;

class GuitarCardController extends Controller
{
    private function getCurrentUser() {
        $em = $this->getDoctrine()->getManager();
        $username = $this->getUser()->getUsername();
        return $em->getRepository(UserAccount::class)->findOneBy(['username' => $username]);
    }

    /**
    * @Route("/{id}/add", requirements={"id" = "\d+"}, name="add_guitar_route")
    */
    public function addGuitarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $currentUser = $this->getCurrentUser();

        if (!$currentUser) {
            return $this->redirectToRoute('auth');
        }

        $guitar = $em->getRepository(Guitar::class)->find($id);
        $currentUser->getGuitars()->add($guitar);
        $em->flush();

        return new Response();
    }
}
