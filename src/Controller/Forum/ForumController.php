<?php

namespace App\Controller\Forum;

class ForumController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->redirectToRoute('base');
    }

    public function show(string $slug)
    {
        $this->data['slug_forum'] = $slug;

        return $this->renderer('forum/forum.html.twig');
    }
}
