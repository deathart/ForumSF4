<?php

namespace App\Controller\Forum;

use App\Entity\Category;
use App\Entity\Forum;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CatController extends BaseController
{
    /**
     * ForumController constructor.
     *
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     * @param \Symfony\Component\HttpFoundation\RequestStack             $request
     */
    public function __construct(SessionInterface $session, RequestStack $request)
    {
        parent::__construct($session, $request);
        $this->title = 'Category';
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
        $getInfoCat = $this->getDoctrine()->getRepository(Category::class)->findOneBy(['slug' => $slug]);

        $this->breadcrumb[] = ['url' => 'active', 'name' => $getInfoCat->getName()];

        $this->data['slug_forum'] = $slug;

        $this->data['cat_info'] = [
            'id' => $getInfoCat->getId(),
            'name' => $getInfoCat->getName(),
            'desc' => $getInfoCat->getDesc(),
            'slug' => $getInfoCat->getSlug(),
            'position' => $getInfoCat->getPosition(),
        ];

        $this->data['getForum'] = $this->getDoctrine()->getManager()->getRepository(Forum::class)->findAllWithoutParent($getInfoCat->getId());

        $this->stitle = $getInfoCat->getName();

        return $this->renderer('cat/show.html.twig');
    }
}
