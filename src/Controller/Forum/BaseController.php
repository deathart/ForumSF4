<?php

namespace App\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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
    public $title;
    /**
     * @var string
     */
    public $stitle;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function init() {
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
    public function setTitle(): string
    {
        $tf = $this->title;
        if (!empty($this->stitle)) {
            $tf .= ' - '.$this->stitle;
        }

        return $tf;
    }

    public function breadcrumb(): string
    {
        $route_name = $this->get('request_stack')->getCurrentRequest()->attributes->get('_route');
        if($route_name !== 'base') {
            $bread = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
            $bread .= '<li class="breadcrumb-item"><a href="#" class="font-weight-bold"><i class="fa fa-home" aria-hidden="true"></i></a></li>';
            $bread .= '<li class="breadcrumb-item active" aria-current="page">Slug</li>';
            $bread .= '</ol></nav>';
            return $bread;
        }
        return '<a href="#" class="font-weight-bold">Forum NAME</a>';
    }

    /**
     * @param string $view
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderer(string $view): Response
    {
        $this->data['titlePage'] = $this->setTitle();

        $this->data['css'] = $this->css;
        $this->data['js'] = $this->js;

        $this->data['breadcrumb'] = $this->breadcrumb();

        return $this->render('forum/page/'.$view, $this->data);
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
}
