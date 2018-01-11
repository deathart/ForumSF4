<?php

namespace App\Controller\Forum;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['test'] = 'Test data';

        return $this->renderer('home.html.twig');
    }
}
