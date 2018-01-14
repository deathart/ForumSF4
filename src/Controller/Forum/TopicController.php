<?php

namespace App\Controller\Forum;

/**
 * Class TopicController.
 */
class TopicController extends BaseController
{
    /**
     * TopicController constructor.
     */
    public function __construct()
    {
        parent::__construct ();
        $this->title = 'Topic';
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
        $this->data['slug_topic'] = $slug;

        $this->stitle = $slug;

        return $this->renderer('topic/show.html.twig');
    }
}
