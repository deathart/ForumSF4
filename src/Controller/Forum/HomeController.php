<?php

namespace App\Controller\Forum;

/**
 * Class HomeController
 *
 * @package App\Controller\Forum
 */
class HomeController extends BaseController
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Home';
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->renderer('home.html.twig');
    }
}
