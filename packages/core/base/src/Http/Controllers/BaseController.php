<?php

namespace Messi\Base\Http\Controllers;

use Illuminate\Routing\Controller;
use View;


class BaseController extends Controller
{
    /**
     * @var string
     */
    private $type = 'success';

    /**
     * @var string
     */
    private $msg = 'Action successfully';

    /**
     * @param $type
     * @return BaseController
     */
    public function setType($type) : self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $msg
     * @return BaseController
     */
    public function setMsg(string $msg) : self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * @param string $route
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function redirect(string $route)
    {
        return redirect($route)->with(['type' => $this->type, 'msg' => $this->msg]);
    }

    /**
     * @param string $title
     */
    protected function setTitle(string $title)
    {
        View::share('title', $title);
    }

    /**
     * @param array $breadcrumbs
     */
    protected function setBreadcrumbs(array $breadcrumbs = [])
    {
        View::composer(['core/base::layouts.partials.breadcrumbs'], function ($view) use ($breadcrumbs) {
            $view->with('breadcrumbs', $breadcrumbs);
        });
    }
}
