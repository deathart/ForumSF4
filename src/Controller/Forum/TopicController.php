<?php

namespace App\Controller\Forum;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TopicController.
 */
class TopicController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return $this->redirectToRoute('base');
    }

    /**
     * @param string $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \LogicException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function show(string $slug): Response
    {
        $this->breadcrumb = [
            ['url' => 'forum/communaute', 'name' => 'Communaute'],
            ['url' => 'active', 'name' => $slug],
        ];

        $this->data['slug_topic'] = $slug;

        $this->title = $slug;

        return $this->renderer('topic/show.html.twig');
    }
}
