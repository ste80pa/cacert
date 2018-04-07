<?php
namespace App\Security\User;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
/**
 * @link https://symfony.com/doc/current/security/custom_provider.html
 * @link https://github.com/hwi/HWIOAuthBundle/blob/master/Resources/doc/1-setting_up_the_bundle.md
 * @author Stefano Pallozzi
 *        
 */
class OAuthProvider implements OAuthAwareUserProviderInterface
{
    
    
    /**
     *
     * @var Registry
     */
    private $doctrine;
    
    /**
     *
     * @var TokenStorage
     */
    private $tokenStorage;
    
    /**
     *
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine, TokenStorage $tokenStorage)
    {
        $this->doctrine = $doctrine;
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * 
     * {@inheritDoc}
     * @see \HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface::loadUserByOAuthUserResponse()
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        
        print_r($response);
        $username = $response->getUsername();
        
     //   $this->doctrine->getRepository(User::class)->findUserBy(array($this->getProperty($response) => $username));
      //  $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
        //when the user is registrating
        if (null === $user) {
            $service = $response->getResourceOwner()->getName();
            $setter = 'set'.ucfirst($service);
            $setter_id = $setter.'Id';
            $setter_token = $setter.'AccessToken';
            // create new user here
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            //I have set all requested data with the user's username
            //modify here with relevant data
            $user->setUsername($username);
            $user->setEmail($username);
            $user->setPassword($username);
           // $user->setEnabled(true);
           // $this->userManager->updateUser($user);
            return $user;
        }
        //if user exists - go with the HWIOAuth way
        $user = parent::loadUserByOAuthUserResponse($response);
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';
        //update access token
        $user->$setter($response->getAccessToken());
        return $user;
    }


   

}