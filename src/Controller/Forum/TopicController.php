<?php

namespace App\Controller\Forum;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class TopicController.
 */
class TopicController extends BaseController
{

    /**
     * TopicController constructor.
     *
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     * @param \Symfony\Component\HttpFoundation\RequestStack $request
     */
    public function __construct(SessionInterface $session, RequestStack $request)
    {
        parent::__construct ($session, $request);
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
        $this->breadcrumb = [
            ['url' => 'forum/communaute', 'name' => 'Communaute'],
            ['url' => 'active', 'name' => $slug]
        ];

        $this->data['slug_topic'] = $slug;

        $this->stitle = $slug;

        return $this->renderer('topic/show.html.twig');
    }
}
