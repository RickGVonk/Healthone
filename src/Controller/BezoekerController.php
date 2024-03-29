<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BezoekerController extends AbstractController
{
    /**
     * @Route("/bezoeker", name="bezoeker")
     */
    public function indexAction()
    {
        return $this->render('bezoeker/index.html.twig');
    }
}
