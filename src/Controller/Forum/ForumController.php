<?php

namespace App\Controller\Forum;

/**
 * Class ForumController.
 */
class ForumController extends BaseController
{
    /**
     * ForumController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Forum';
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index()
    {
        return $this->redirectToRoute('base');
    }

    /**
     * @param string $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(string $slug)
    {
        $this->data['slug_forum'] = $slug;

        $this->stitle = $slug;

        return $this->renderer('forum/show.html.twig');
    }
}
