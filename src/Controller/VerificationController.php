<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Email;

class VerificationController extends Controller
{

    /**
     *
     * @Route("/verify/email/{email}/{hash}", name="verify_email")
     */
    public function verifyEmailAddress(Request $request, Email $email = null, string $hash = null)
    {
        if ($email === null || $hash == null) {
            return $this->render('verification/email/error.html.twig');
        }

        if ($email->isVerified()) {
            return $this->render('verification/email/already_verified.html.twig');
        }

        $success = $email->verify($hash);

        $em = $this->getDoctrine()->getManager();
        $em->persist($email);
        $em->flush();
        
        if ($success) {
            return $this->render('verification/email/success.html.twig');
        }

        return $this->render('verification/email/error.html.twig');
    }
}
