<?php

namespace App\Controller\Forum;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\RequestStack;
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
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function index()
    {
        $this->data['category'] = $this->getDoctrine()->getManager()->getRepository(Category::class)->findAllWithoutParent();

        return $this->renderer('home.html.twig');
    }
}
