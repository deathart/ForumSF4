<?php namespace App\Controller\Forum;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BaseController
 *
 * @package App\Controller\Forum
 */
class BaseController extends Controller {

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
     * BaseController constructor.
     */
    public function __construct () {
        //Set CSS
        $this->set_css ("assets/css/vendor/bootstrap.css");

        //Set JS
        $this->set_js("assets/js/vendor/jquery.min.js");
        $this->set_js("assets/js/vendor/popper.min.js");
        $this->set_js("assets/js/vendor/bootstrap.min.js");
        $this->set_js("assets/js/vendor/cookie.min.js");
    }

    /**
     * @param string $file link
     *
     * @return string $this
     */
    public function set_css(string $file)
    {
        $this->css[]['file'] = $file;
        return $this;
    }
    /**
     * @param string $file link
     *
     * @return string $this
     */
    public function set_js(string $file)
    {
        $this->js[]['file'] = $file;
        return $this;
    }

    /**
     * @param string $view
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderer (string $view) {

        $this->data['css'] = $this->css;
        $this->data['js'] = $this->js;

        return $this->render ("forum/page/" . $view, $this->data);
    }

}