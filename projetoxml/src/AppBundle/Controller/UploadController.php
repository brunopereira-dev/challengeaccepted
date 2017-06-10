<?php

// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UploadController extends Controller
{
    /**
     * @Route("/upload/xml")
     */
    public function xmlAction()
    {
        //throw $this->createNotFoundException('Erro na pagina');
        $number = mt_rand(0, 100);

        return $this->render('xml/xml.html.twig', array(
            'number' => $number,
        ));
    }
}
