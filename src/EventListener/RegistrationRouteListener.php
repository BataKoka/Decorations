<?php
/**
 * Created by PhpStorm.
 * User: Marko R
 * Date: 22/04/2018
 * Time: 15:19
 */

namespace App\EventListener;


use FOS\UserBundle\Model\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RegistrationRouteListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorageInterface;

    /**
     * @var RouterInterface
     */
    private $routerInterface;

    /**
     * RegistrationRouteListener constructor.
     * @param TokenStorageInterface $tokenStorageInterface
     * @param RouterInterface $routerInterface
     */
    public function __construct(TokenStorageInterface $tokenStorageInterface, RouterInterface $routerInterface)
    {
        $this->tokenStorageInterface = $tokenStorageInterface;
        $this->routerInterface = $routerInterface;
    }

    /**
     * @param GetResponseEvent $event
     * @return bool|RedirectResponse
     * @throws \InvalidArgumentException
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($request->get('_route') !== 'fos_user_registration_register') {
            return false;
        }

        if ($this->tokenStorageInterface->getToken() === null) {
            return false;
        }

        if ($this->tokenStorageInterface->getToken() instanceof AnonymousToken) {
            return false;
        }

        if ( ! $this->tokenStorageInterface->getToken()->getUser() instanceof User ) {
            return false;
        }

        return $event->setResponse(
            new RedirectResponse(
                $this->routerInterface->generate('index')
            )
        );
    }
}