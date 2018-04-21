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
 *
 * @link https://symfony.com/doc/current/security/custom_provider.html
 * @link https://github.com/hwi/HWIOAuthBundle/blob/master/Resources/doc/1-setting_up_the_bundle.md
 * @author Stefano Pallozzi
 *        
 */
class OAuthProvider implements UserProviderInterface, OAuthAwareUserProviderInterface
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
     * {@inheritdoc}
     * @see \HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface::loadUserByOAuthUserResponse()
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {

        $user = $this->doctrine->getRepository(User::class)->findOneBy([
            'email' => $response->getEmail()
        ]);
        
        if (null === $user) {
            
            $user = new User();
            
            $response->getLastName();
            //$username = $response->getUsername();
            $user->setUsername($response->getEmail());
            $user->setEmail($response->getEmail());
            //$user->setPassword();
            $user->setFirstName($response->getFirstName());
            $user->setLastName($response->getLastName());
            /*
            $service = $response->getResourceOwner()->getName();
            $setter = 'set' . ucfirst($service);
            $setter_id = $setter . 'Id';
            $setter_token = $setter . 'AccessToken';
            // create new user here
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            // I have set all requested data with the user's username
            // modify here with relevant data
            $user->setUsername($username);
            $user->setEmail($username);
            $user->setPassword($username);
            // $user->setEnabled(true);
            // $this->userManager->updateUser($user);*/
            return $user;
        }
        // if user exists - go with the HWIOAuth way
        //$user = parent::loadUserByOAuthUserResponse($response);
        //$serviceName = $response->getResourceOwner()->getName();
        //$setter = 'set' . ucfirst($serviceName) . 'AccessToken';
        // update access token
        //$user->$setter($response->getAccessToken());
        return $user;
    }

    /**
     *
     * @param string $class
     * @return boolean
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }

    /**
     *
     * @param UserInterface $user
     * @throws UnsupportedUserException
     * @return object|NULL
     */
    public function refreshUser(UserInterface $user)
    {
        if (! $user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     *
     * @param string $username
     * @throws UsernameNotFoundException
     * @return object|NULL
     */
    public function loadUserByUsername($username)
    {
        $user = $this->doctrine->getRepository(User::class)->findOneBy([
            'email' => $username
        ]);
        if ($user === null) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        return $user;
    }
}