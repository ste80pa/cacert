<?php
namespace App\Controller;

use App\Entity\Domains;
use App\Entity\Email;
use App\Entity\User;
use App\Form\AccountSettingsType;
use App\Form\ChangeAlertsType;
use App\Form\ChangeListingType;
use App\Form\DomainsType;
use App\Form\EmailType;
use App\Form\UserRegistrationType;
use App\Utils\Cacert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\FormInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormError;
use App\Form\ChangePasswordType;
use App\Form\ChangeLanguagesType;
use App\Form\ChangeSecurityQuestionsType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class UserController extends Controller
{

    /**
     *
     * @Route("/login", name="login")
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        $format = $request->getRequestFormat();
        $error = $authUtils->getLastAuthenticationError();
        
        if($format == 'html')
        {
            // get the login error if there is one
           
    
            // last username entered by the user
            $lastUsername = $authUtils->getLastUsername();
    
            return $this->render('login.html.twig', array(
                'login_username' => $lastUsername,
                'login_error' => $error
            ));
        }
        
        /* @var $serializer Serializer */
        $serializer = $this->get('serializer');
        
        return new Response($serializer->serialize($error, $format, [
            'groups' => [
                'api'
            ]
        ]));
    }

    /**
     *
     * @Route("/account/change/alerts", name="account_change_alerts", methods={"POST"}, condition="request.isXmlHttpRequest()")
     * @param Request $request
     */
    public function changeAlerts(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(ChangeAlertsType::class, $user,
            [
                'action' => $this->generateUrl('account_change_alerts'),
                'method' => 'POST'
            ]);

        $form->handleRequest($request);
        $utils = $this->get('cacert.form_utils');

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $em->persist($user);
            $em->flush();

            return new JsonResponse([
                'message' => 'Success!'
            ], 200);
        }

        return new JsonResponse([
            'message' => 'Fail!',
            'errors' => $utils->invalidFormToAjaxErrors($form)
        ], 200);
    }

    /**
     *
     * @Route("/account/change/languages", name="account_change_languages", methods={"POST"}, condition="request.isXmlHttpRequest()")
     * @param Request $request
     */
    public function changeLanguages(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(ChangeLanguagesType::class, $user,
            [
                'action' => $this->generateUrl('account_change_languages'),
                'method' => 'POST'
            ]);

        $form->handleRequest($request);
        $utils = $this->get('cacert.form_utils');

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $em->persist($user);
            $em->flush();

            return new JsonResponse([
                'message' => 'Success!'
            ], 200);
        }

        return new JsonResponse([
            'message' => 'Fail!',
            'errors' => $utils->invalidFormToAjaxErrors($form)
        ], 200);
    }

    /**
     *
     * @Route("/account/change/securityquestions", name="account_change_securityquestions", methods={"POST"}, condition="request.isXmlHttpRequest()")
     * @param Request $request
     */
    public function changeSecurityQuestions(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(ChangeSecurityQuestionsType::class, $user,
            [
                'action' => $this->generateUrl('account_change_securityquestions'),
                'method' => 'POST'
            ]);

        $form->handleRequest($request);
        $utils = $this->get('cacert.form_utils');

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $em->persist($user);
            $em->flush();

            return new JsonResponse([
                'message' => 'Success!'
            ], 200);
        }

        return new JsonResponse([
            'message' => 'Fail!',
            'errors' => $utils->invalidFormToAjaxErrors($form)
        ], 200);
    }

    /**
     *
     * @Route("/account/change/listing", name="account_change_listing", methods={"POST"}, condition="request.isXmlHttpRequest()")
     * @param Request $request
     */
    public function changeListing(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(ChangeListingType::class, $user,
            [
                'action' => $this->generateUrl('account_change_listing'),
                'method' => 'POST'
            ]);

        $form->handleRequest($request);
        $utils = $this->get('cacert.form_utils');

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $em->persist($user);
            $em->flush();

            return new JsonResponse([
                'message' => 'Success!'
            ], 200);
        }

        return new JsonResponse([
            'message' => 'Fail!',
            'errors' => $utils->invalidFormToAjaxErrors($form)
        ], 200);
    }

    /**
     *
     * @Route("/account/change/password", name="account_change_password", methods={"POST"}, condition="request.isXmlHttpRequest()")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getUser();
        $oldPassword = $user->getPassword();

        $form = $this->createForm(ChangePasswordType::class, $user,
            [
                'action' => $this->generateUrl('account_change_password'),
                'method' => 'POST'
            ]);

        $form->handleRequest($request);
        $utils = $this->get('cacert.form_utils');

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $user = $form->getData();

            if (empty($user->getPlainPassword())) {
                $user->setPassword($oldPassword);
            } else {
                $user->setPassword($passwordEncoder->encodePassword($user, $user->getPlainPassword()));
            }

            $em->persist($user);
            $em->flush();

            return new JsonResponse([
                'message' => 'Success!'
            ], 200);
        }

        return new JsonResponse([
            'message' => 'Fail!',
            'errors' => $utils->invalidFormToAjaxErrors($form)
        ], 200);
    }

    /**
     * 
     * @Route("/account/settings/{_format}", name="account_settings",methods={"GET"}, defaults={"_format" = "html"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     *
     */
    public function settings(Request $request)
    {
        $user = $this->getUser();

        $format = $request->getRequestFormat();
        
        if($format == 'html')
        {
        /* @var $form FormInterface */

        $formPassword = $this->createForm(ChangePasswordType::class, $user,
            [
                'action' => $this->generateUrl('account_change_password'),
                'method' => 'POST'
            ]);

        $formLanguages = $this->createForm(ChangeLanguagesType::class, $user,
            [
                'action' => $this->generateUrl('account_change_languages'),
                'method' => 'POST'
            ]);

        $formSecurityQuestions = $this->createForm(ChangeSecurityQuestionsType::class, $user,
            [
                'action' => $this->generateUrl('account_change_securityquestions'),
                'method' => 'POST'
            ]);

        $formAlerts = $this->createForm(ChangeAlertsType::class, $user,
            [
                'action' => $this->generateUrl('account_change_alerts'),
                'method' => 'POST'
            ]);

        $formListing = $this->createForm(ChangeListingType::class, $user,
            [
                'action' => $this->generateUrl('account_change_listing'),
                'method' => 'POST'
            ]);

        return $this->render('account/html/settings.html.twig',
            [
                'form_password' => $formPassword->createView(),
                'form_languages' => $formLanguages->createView(),
                'form_questions' => $formSecurityQuestions->createView(),
                'form_alerts' => $formAlerts->createView(),
                'form_listing' => $formListing->createView()
            ]);
        }
        
        /* @var $serializer Serializer */
        $serializer = $this->get('serializer');
        
        return new Response($serializer->serialize($user, $format, [
            'groups' => [
                'api'
            ]
        ]));
    }

    /**
     *
     * @deprecated
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    protected function ajaxHandle()
    {
        $user = $this->getUser();
        $oldPassword = $user->getPassword();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $isValid = $form->isValid();
            $isAjax = $request->isXmlHttpRequest();

            if ($isAjax && ! $isValid) {

                return new JsonResponse([
                    'message' => 'Fail!',
                    'errors' => $errors
                ], 200);
            }

            if ($isValid) {

                $em = $this->getDoctrine()->getManager();

                $user = $form->getData();

                if (empty($user->getPlainPassword())) {
                    $user->setPassword($oldPassword);
                } else {
                    $user->setPassword($passwordEncoder->encodePassword($user, $user->getPlainPassword()));
                }

                $em->persist($user);
                $em->flush();

                if ($isAjax) {
                    return new JsonResponse([
                        'message' => 'Success!'
                    ], 200);
                }
            }
        }
    }

    /**
     *
     * @Route("/account/domains/{_format}", name="account_domains", defaults={"_format"="html"})
     * @param Request $request
     */
    public function domains(Request $request)
    {
        /** @var User */
        $user = $this->getUser();
       
        $format = $request->getRequestFormat();

        if ($format == 'html') {
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

            return $this->render('account/html/domains.html.twig',
                [
                    'form' => $form->createView(),
                    'domains' => $user->getDomains()
                ]);
        }

        /* @var $serializer Serializer */
        $serializer = $this->get('serializer');

        return new Response($serializer->serialize($user->getDomains(), $format, [
            'groups' => [
                'api'
            ]
        ]));
    }

    /**
     *
     * @Route("/account/client_certificates", name="account_client_certificates")
     * @param Request $request
     */
    public function clientCertificates(Request $request)
    {
        return $this->render('account/html/client_certificates.html.twig', []);
    }

    /**
     *
     * @Route("/account/server_certificates", name="account_server_certificates")
     * @param Request $request
     */
    public function serverCertificates(Request $request)
    {
        return $this->render('account/html/server_certificates.html.twig', []);
    }

    /**
     *
     * @Route("/account/gpg_pgp_keys", name="account_gpg_pgp_keys")
     * @param Request $request
     */
    public function gpgPgpKeys(Request $request)
    {
        return $this->render('account/html/gpg_pgp_keys.html.twig', []);
    }

    /**
     *
     * @Route("/account/emails/{_format}", name="account_emails", defaults={"_format"="html"})
     * @param Request $request
     */
    public function emails(Request $request)
    {
        $user = $this->getUser();

        $format = $request->getRequestFormat();

        if ($format == 'html') {
            $email = new Email();
            $form = $this->createForm(EmailType::class, $email);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /* @var $cacert Cacert */

                $cacert = $this->get('cacert');

                $em = $this->getDoctrine()->getManager();
                $email = $form->getData();

                $email->setHash($cacert->makeHash());
                $email->setUser($user);

                $em->persist($email);
                $em->flush();

                $cacert->sendEmailVerificationEmail($email);
            }

            return $this->render("account/html/emails.{$format}.twig",
                [
                    'form' => $form->createView(),
                    'emails' => $user->getEmails()
                ]);
        }
        /* @var $serializer Serializer */
        $serializer = $this->get('serializer');

        return new Response($serializer->serialize($user->getEmails(), $format, [
            'groups' => [
                'api'
            ]
        ]));
    }

    /**
     *
     * @Route("/account/dashboard", name="account_dashboard")
     * @param Request $request
     */
    public function dashboard(Request $request)
    {
        return $this->render('account/html/dashboard.html.twig', []);
    }

    /**
     *
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
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPlainPassword()));
            $em->persist($user);

            // Add email verify entry
            $email = new Email();
            $email->setUser($user);
            $email->setHash($hash);
            $email->setEmail($user->getEmail());
            $em->persist($email);
            $em->flush();

            $cacert->sendRegistrationMail($user, $email);

            return $this->render('registration_success.html.twig', [
                'language' => '',
                'user' => $user
            ]);
            // return $this->redirectToRoute('index');
        }

        return $this->render('join.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
