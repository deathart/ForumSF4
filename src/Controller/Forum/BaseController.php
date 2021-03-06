<?php

namespace App\Controller\Forum;

use App\Entity\Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class BaseController.
 */
class BaseController extends Controller
{
    /**
     * @var array
     */
    protected $data = [];
    /**
     * @var array
     */
    protected $css = [];
    /**
     * @var array
     */
    protected $js = [];
    /**
     * @var string
     */
    protected $title;
    /**
     * @var array
     */
    protected $breadcrumb;
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    private $request;
    /**
     * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    private $session;

    /**
     * BaseController constructor.
     *
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     * @param \Symfony\Component\HttpFoundation\RequestStack             $request
     */
    public function __construct(SessionInterface $session, RequestStack $request)
    {
        $this->request = $request;
        $this->session = $session;
    }

    /**
     * @return string
     *
     * @throws \LogicException
     */
    protected function bread(): string
    {
        if ('base' !== $this->request->getCurrentRequest()->attributes->get('_route')) {
            $bread = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
            $bread .= '<li class="breadcrumb-item"><a href="'.$this->request->getCurrentRequest()->getSchemeAndHttpHost().'" class="font-weight-bold"><i class="fa fa-home" aria-hidden="true"></i></a></li>';
            if (!empty($this->breadcrumb)) {
                foreach ($this->breadcrumb as $databread) {
                    if ('active' !== $databread['url']) {
                        $bread .= '<li class="breadcrumb-item"><a href="'.$this->request->getCurrentRequest()->getSchemeAndHttpHost().'/'.$databread['url'].'" class="font-weight-bold">'.$databread['name'].'</a></li>';
                    } else {
                        $bread .= '<li class="breadcrumb-item active" aria-current="page">'.$databread['name'].'</li>';
                    }
                }
            }
            $bread .= '</ol></nav>';

            return $bread;
        }

        return '<a href="'.$this->request->getCurrentRequest()->getSchemeAndHttpHost().'" class="font-weight-bold">'.$this->data['foruminfo']['title'].'</a>';
    }

    /**
     * @param string $file link
     *
     * @return $this
     */
    protected function set_css(string $file)
    {
        $this->css[]['file'] = $file;

        return $this;
    }

    /**
     * @param string $file link
     *
     * @return $this
     */
    protected function set_js(string $file)
    {
        $this->js[]['file'] = $file;

        return $this;
    }

    /**
     * @param string $view
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \LogicException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function renderer(string $view): Response
    {
        $translator = $this->get('translator');
        $translator->setLocale($this->GetConfig('lang'));

        $this->data['foruminfo'] = [
            'title' => $this->GetConfig('title'),
            'description' => $this->GetConfig('desc'),
            'facebook_link' => $this->GetConfig('facebook_link'),
            'twitter_link' => $this->GetConfig('twitter_link'),
            'google_link' => $this->GetConfig('google_link'),
        ];

        $this->data['titlePage'] = $this->title;

        $this->data['css'] = $this->css;
        $this->data['js'] = $this->js;

        $this->data['breadcrumb'] = $this->bread();

        return $this->render('forum/page/'.$view, $this->data);
    }

    /**
     * @param string $key
     *
     * @return string
     *
     * @throws \LogicException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function GetConfig(string $key): string
    {
        $configVal = $this->getDoctrine()->getRepository(Config::class)->findDataByKey($key);

        if ($configVal) {
            return $configVal->getValue();
        }

        return false;
    }
}
