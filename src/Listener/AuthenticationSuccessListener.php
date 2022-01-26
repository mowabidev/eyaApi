<?php

namespace App\Listener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class AuthenticationSuccessListener
{
    private $jwtTokenTTL;

    private $cookieSecure = true;

    public function __construct($jwtTokenTTL)
    {
        $this->jwtTokenTTL = $jwtTokenTTL;
    }

    /**
     * This function is responsible for the authentication part
     *
     * @param AuthenticationSuccessEvent $event
     * @return JWTAuthenticationSuccessResponse
     */
    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {
        /** @var JWTAuthenticationSuccessResponse $response */
        $response = $event->getResponse();
        $data = $event->getData();
        $user = $event->getUser();
        
        $data["user"] = [
          "firstname" => $user->getFirstname(),
          "lastname" => $user->getLastname(),
          "image" => $user->getImage(),
        ];
        $tokenJWT = $data['token'];
        //unset($data['token']);
        //unset($data['refresh_token']);
        $event->setData($data);

        $response->headers->setCookie(new Cookie('BEARER', $tokenJWT, (
            new \DateTime())
            ->add(new \DateInterval('PT' . $this->jwtTokenTTL . 'S')), '/', null, $this->cookieSecure));

        return $response;
    }
}