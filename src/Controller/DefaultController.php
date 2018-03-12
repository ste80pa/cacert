<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Stefano Pallozzi <ste80pa@gmail.com>
 */
class DefaultController extends Controller
{

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render(
            'index.html.twig',
            [
                'language' => '',
            ]
        );
    }

    /**
     * @Route("/policy/root", name="policy_root_distribution_license")
     */
    public function indexPolicyRootDistrubutionLicense()
    {
        return $this->render('policy/root_distribution_license.html.twig', ['language', '']);
    }

    /**
     * @Route("/mission", name="index_mission")
     */
    public function indexMission()
    {
        return $this->render('mission.html.twig', ['language', '']);
    }

    

}
