<?php

namespace App\Controller\Forum;

use App\Entity\Category;
use App\Entity\Forum;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class HomeController.
 */
class HomeController extends BaseController
{
    /**
     * HomeController constructor.
     *
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     * @param \Symfony\Component\HttpFoundation\RequestStack             $request
     */
    public function __construct(SessionInterface $session, RequestStack $request)
    {
        parent::__construct($session, $request);
        $this->title = 'Home';
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \LogicException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index(): Response
    {
        $cat = $this->getDoctrine()->getManager()->getRepository(Category::class)->findAllByOrder();
        $this->data['category'] = [];

        foreach ($cat as $data_cat) {
            $data_cat['forum'] = $this->getDoctrine()->getManager()->getRepository(Forum::class)->findAllWithoutParent($data_cat['id']);
            $this->data['category'][] = $data_cat;
        }

        return $this->renderer('home.html.twig');
    }
}
