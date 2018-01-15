<?php

namespace App\Controller\Forum;

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
     * @var string
     */
    protected $stitle;
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
     * @param \Symfony\Component\HttpFoundation\RequestStack $request
     */
    public function __construct(SessionInterface $session, RequestStack $request)
    {
        $this->request = $request;
        $this->session = $session;
        $this->init();
    }

    /**
     * @return $this
     */
    protected function init() {
        //Set CSS
        $this->set_css('assets/css/vendor/font-awesome.css');
        $this->set_css( 'assets/css/forum/bootstrap.css');
        $this->set_css( 'assets/css/forum/style.css');
        //Set JS
        $this->set_js('assets/js/vendor/jquery.min.js');
        $this->set_js('assets/js/vendor/popper.min.js');
        $this->set_js('assets/js/vendor/bootstrap.min.js');
        $this->set_js('assets/js/vendor/cookie.min.js');
        $this->set_js('assets/js/vendor/scroll.min.js');
        $this->set_js('assets/js/forum/app.js');

        return $this;
    }

    /**
     * @return string
     */
    protected function setTitle(): string
    {
        $tf = $this->title;
        if (!empty($this->stitle)) {
            $tf .= ' - '.$this->stitle;
        }

        return $tf;
    }

    /**
     * @return string
     */
    protected function bread(): string
    {
        if($this->request->getCurrentRequest()->attributes->get('_route') !== 'base') {
            $bread = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
            $bread .= '<li class="breadcrumb-item"><a href="#" class="font-weight-bold"><i class="fa fa-home" aria-hidden="true"></i></a></li>';
            if(!empty($this->breadcrumb)) {
                foreach($this->breadcrumb as $key => $databread) {
                    if($databread['url'] != 'active') {
                        $bread .= '<li class="breadcrumb-item"><a href="' . $databread['url'] . '" class="font-weight-bold">' . $databread['name'] . '</a></li>';
                    }
                    else {
                        $bread .= '<li class="breadcrumb-item active" aria-current="page">' . $databread['name'] . '</li>';
                    }
                }
            }
            $bread .= '</ol></nav>';
            return $bread;
        }
        return '<a href="#" class="font-weight-bold">Forum NAME</a>';
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
     */
    protected function renderer(string $view): Response
    {
        $this->data['titlePage'] = $this->setTitle();

        $this->data['css'] = $this->css;
        $this->data['js'] = $this->js;

        $this->data['breadcrumb'] = $this->bread();

        return $this->render('forum/page/'.$view, $this->data);
    }
}
