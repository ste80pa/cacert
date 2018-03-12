<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
/**
 * 
 */
class LocaleSubscriber implements EventSubscriberInterface
{
    /**
     *  bin/console debug:event kernel.request. must be called before Symfony\Component\HttpKernel\EventListener\LocaleListener::onKernelRequest() 
     */
    const PRIORITY = 20;
    /**
     *
     */
    private $defaultLocale = 'en';
    
    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
       
        $locale = $this->defaultLocale;

        if (!$request->hasPreviousSession()) {
            return;
        }

        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } elseif ($locale = $request->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            $locale = $request->getSession()->get('_locale', $this->defaultLocale);
        }

        $request->setLocale($locale);
    }

    public static function getSubscribedEvents()
    {
        return [ KernelEvents::REQUEST => [['onKernelRequest', self::PRIORITY]]];
       
    }
}