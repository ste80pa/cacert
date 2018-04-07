<?php
namespace App\Tests\Form\Type;

use App\Entity\AddLang;
use App\Entity\Alerts;
use App\Entity\SecurityQuestions;
use App\Entity\User;
use App\Form\AccountSettingsType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class AccountSettingsTypeTest extends TypeTestCase
{
    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Form\Test\TypeTestCase::getExtensions()
     */
    protected function getExtensions()
    {
        return array(new ValidatorExtension(Validation::createValidator()));
    }
    
    /**
     * 
     */
    public function testAccountSettingsType()
    {
        $user = new User();
        $addLang0 = new AddLang();
        $addLang1 = new AddLang();
        $addLang2 = new AddLang();
        $alerts = new Alerts();
        $securityQuestions = new SecurityQuestions();

        $addLang0->setLang('en_UK');
        $addLang1->setLang('it_IT');
        $addLang2->setLang('de_DE');

        $alerts->setRadius(true);
        $alerts->setCountry(true);
        $alerts->setGeneral(true);
        $alerts->setRegional(true);

        $securityQuestions->setQuestion1('Q1');
        $securityQuestions->setQuestion2('Q2');
        $securityQuestions->setQuestion3('Q3');
        $securityQuestions->setQuestion4('Q4');
        $securityQuestions->setQuestion5('Q5');
        $securityQuestions->setAnswer1('A1');
        $securityQuestions->setAnswer2('A2');
        $securityQuestions->setAnswer3('A3');
        $securityQuestions->setAnswer4('A4');
        $securityQuestions->setAnswer5('A5');

        $user->setPlainPassword('1234');
        $user->setListMe(true);
        $user->setContactinfo(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac eros a ligula luctus consequat.');

        $user->addLanguage($addLang0);
        $user->addLanguage($addLang1);
        $user->addLanguage($addLang2);
        $user->setSecurityQuestions($securityQuestions);
        $user->setAlerts($alerts);

        $formData = [
            'plainPassword' => [
                'first' => $user->getPlainPassword(),
                'second' => $user->getPlainPassword()
            ],
            'listme' => $user->getListMe(),
            'contactinfo' => $user->getContactinfo(),
            'questions' => [
                'question1' => $securityQuestions->getQuestion1(),
                'question2' => $securityQuestions->getQuestion2(),
                'question3' => $securityQuestions->getQuestion3(),
                'question4' => $securityQuestions->getQuestion4(),
                'question5' => $securityQuestions->getQuestion5(),
                'answer1' => $securityQuestions->getAnswer1(),
                'answer2' => $securityQuestions->getAnswer2(),
                'answer3' => $securityQuestions->getAnswer3(),
                'answer4' => $securityQuestions->getAnswer4(),
                'answer5' => $securityQuestions->getAnswer5()
            ],
            'languages' => [
                [
                    'lang' => $addLang0->getLang()
                ],
                [
                    'lang' => $addLang1->getLang()
                ],
                [
                    'lang' => $addLang2->getLang()
                ]
            ],
            'alerts' => [
                'general' => $alerts->getGeneral(),
                'country' => $alerts->getCountry(),
                'regional' => $alerts->getRegional(),
                'radius' => $alerts->getRadius()
            ]
        ];

        $userToCompare = new User();
        $form = $this->factory->create(AccountSettingsType::class, $userToCompare);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($user, $userToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}