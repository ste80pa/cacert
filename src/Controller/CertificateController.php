<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/certificate/")
 */
class CertificateController extends Controller
{
    /**
     * @Route("", name="certificate_index")
     * @Route("root", name="certificate_root")
     */
    public function index()
    {
        return $this->render('certificate/index.html.twig', []);
    }
}
