<?php

namespace App\Controller\Forum;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class FaqController.
 */
class FaqController extends BaseController
{
    /**
     * FaqController constructor.
     *
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     * @param \Symfony\Component\HttpFoundation\RequestStack             $request
     */
    public function __construct(SessionInterface $session, RequestStack $request)
    {
        parent::__construct($session, $request);
        $this->title = 'Topic';
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \LogicException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(): Response
    {
        $this->breadcrumb = [
            ['url' => 'active', 'name' => 'faq'],
        ];

        return $this->renderer('faq/index.html.twig');
    }
}
