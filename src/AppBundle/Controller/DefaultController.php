<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Guitar;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homePage(Request $request)
    {
        return $this->render('main/main.html.twig', [ 
            'guitar' => $this->getDoctrine()->getRepository(Guitar::class)->findAll(),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
