<?php

namespace App\Controller\Forum;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class FaqController extends BaseController
{

    public function __construct(SessionInterface $session, RequestStack $request)
    {
        parent::__construct ($session, $request);
        $this->title = 'Topic';
    }

    public function index()
    {
        $this->breadcrumb = [
            ['url' => 'active', 'name' => 'faq']
        ];

        return $this->renderer('faq/index.html.twig');
    }

}
