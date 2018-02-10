<?php

namespace App\Controller\Forum;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class AuthController.
 */
class AuthController extends BaseController
{
    public function __construct(SessionInterface $session, RequestStack $request)
    {
        parent::__construct($session, $request);
        $this->set_js('build/js/forum/auth.js');
    }

    /**
     * @return Response
     *
     * @throws \LogicException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function Register(): Response
    {
        $this->title = 'Register';
        $this->breadcrumb = [
            ['url' => 'active', 'name' => 'Register'],
        ];

        return $this->renderer('auth/register.html.twig');
    }
}
