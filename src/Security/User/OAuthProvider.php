<?php
namespace App\Security\User;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use App\Entity\SecurityQuestions;

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

    
    private  $passwordEncoder;
    /**
     *
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine, TokenStorage $tokenStorage, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->doctrine = $doctrine;
        $this->tokenStorage = $tokenStorage;
        $this->passwordEncoder = $passwordEncoder;
    }
    
    function randomString($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
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
            $data = $response->getData();

            
            $questions = new SecurityQuestions();
            
            $questions->setQuestion1($this->randomString(10));
            $questions->setQuestion2($this->randomString(10));
            $questions->setQuestion3($this->randomString(10));
            $questions->setQuestion4($this->randomString(10));
            $questions->setQuestion5($this->randomString(10));
            
            $questions->setAnswer1('question 1');
            $questions->setAnswer2('question 2');
            $questions->setAnswer3('question 3');
            $questions->setAnswer4('question 4');
            $questions->setAnswer5('question 5');
            
          
            $user->setEmail($response->getEmail());
            $user->setFirstName($response->getFirstName());
            $user->setLastName($response->getLastName());
            $user->setDateOfBirth(new \DateTime());
            
            $user->setPassword($this->passwordEncoder->encodePassword($user, $this->randomString(10)));
            $user->setSecurityQuestions($questions);
            $user->setUniqueID($this->randomString(10));
            $em = $this->doctrine->getManager();   
            $em->persist($user);
            $em->flush();
            
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