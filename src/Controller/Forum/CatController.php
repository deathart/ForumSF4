<?php

namespace App\Controller\Forum;

use App\Entity\Category;
use App\Entity\Forum;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class CatController extends BaseController
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
        $getInfoCat = $this->getDoctrine()->getRepository(Category::class)->findOneBy(['slug' => $slug]);

        $this->breadcrumb[] = ['url' => 'active', 'name' => $getInfoCat->getName()];

        $this->data['slug_forum'] = $slug;

        $this->data['cat_info'] = [
            'id' => $getInfoCat->getId(),
            'name' => $getInfoCat->getName(),
            'description' => $getInfoCat->getDescription(),
            'slug' => $getInfoCat->getSlug(),
            'position' => $getInfoCat->getPosition(),
        ];

        $this->data['getForum'] = $this->getDoctrine()->getManager()->getRepository(Forum::class)->findAllWithoutParent($getInfoCat->getId());

        $this->title = $getInfoCat->getName();

        return $this->renderer('cat/show.html.twig');
    }
}
