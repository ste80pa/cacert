<?php

namespace App\Controller;

use App\Entity\Email;
use App\Entity\User;
use App\Form\AccountSettingsType;
use App\Form\UserRegistrationType;
use App\Utils\Cacert;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\DomainsType;
use App\Entity\Domains;
use App\Form\EmailType;

/**
 * 
 * @author Stefano Pallozzi
 *
 */
class UserController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('login.html.twig', array(
            'login_username' => $lastUsername,
            'login_error' => $error,
        ));
    }
    /**
     * @Route("/account/settings", name="account_settings")
     * @param Request $request
     */
    public function settings(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(AccountSettingsType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $form->getData();

            //$em->persist($user->getLanguages());
            $em->persist($user);
            $em->flush();
        }

        return $this->render('account/settings.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account/domains", name="account_domains")
     * @param Request $request
     */
    public function domains(Request $request)
    {
        /** @var User */
        $user = $this->getUser();
        $domain = new Domains();
        
        
        $form = $this->createForm(DomainsType::class, $domain);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $domain = $form->getData();
            
            $domain->setUser($user);
            $em->persist($domain);
            $em->flush();
        }
        
        return $this->render('account/domains.html.twig', [
            'form' => $form->createView(),
            'domains' => $user->getDomains()
        ]);
    }

    /**
     * @Route("/account/client_certificates", name="account_client_certificates")
     * @param Request $request
     */
    public function clientCertificates(Request $request)
    {
        return $this->render('account/client_certificates.html.twig', []);
    }

    /**
     * @Route("/account/server_certificates", name="account_server_certificates")
     * @param Request $request
     */
    public function serverCertificates(Request $request)
    {
        return $this->render('account/server_certificates.html.twig', []);
    }

    /**
     * @Route("/account/gpg_pgp_keys", name="account_gpg_pgp_keys")
     * @param Request $request
     */
    public function gpgPgpKeys(Request $request)
    {
        return $this->render('account/gpg_pgp_keys.html.twig', []);
    }

    /**
     * @Route("/account/emails", name="account_emails")
     * @param Request $request
     */
    public function emails(Request $request)
    {  
        $user = $this->getUser();
        $email = new Email();
        
        
        $form = $this->createForm(EmailType::class, $email);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $email = $form->getData();
            
            $email->setUser($user);
            $em->persist($email);
            $em->flush();
        }
        
        return $this->render('account/emails.html.twig', [
            'form' => $form->createView(),
            'emails' => $user->getEmails()
        ]);
    }

    /**
     * @Route("/account/dashboard", name="account_dashboard")
     * @param Request $request
     */
    public function dashboard(Request $request)
    {
        return $this->render('account/dashboard.html.twig', []);
    }

    /**
     * @Route("/join", name="join")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cacert = $this->get('cacert');
            $hash = $cacert->makeHash();
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();

            // Fix user
            $user->setUniqueID(Cacert::generateUniqueId($hash));
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
            $em->persist($user);

            // Add email verify entry
            $email = new Email();
            $email->setUser($user);
            $email->setHash($hash);
            $email->setEmail($user->getEmail());
            $em->persist($email);
            $em->flush();

            $cacert->sendRegistrationMail($user, $email);

            return $this->render('registration_success.html.twig', ['language' => '', 'user' => $user]);
            //  return $this->redirectToRoute('index');
        }

        return $this->render(
            'join.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
