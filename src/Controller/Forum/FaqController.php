<?php

namespace App\Controller\Forum;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class FaqController.
 */
class FaqController extends BaseController
{
    /**
     * @return Response
     *
     * @throws \LogicException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(): Response
    {
        $this->title = 'Faq';
        $this->breadcrumb = [
            ['url' => 'active', 'name' => 'faq'],
        ];

        return $this->renderer('faq/index.html.twig');
    }
}
