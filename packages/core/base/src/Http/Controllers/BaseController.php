<?php

namespace Messi\Base\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use View;


class BaseController extends Controller
{
    /**
     * @var string
     */
    private string $type = 'success';

    /**
     * @var string
     */
    private string $msg = 'Action successfully';

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
     * @return RedirectResponse|Redirector
     */
    protected function redirect(string $route): Redirector|RedirectResponse
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
    protected function setBreadcrumbs(array $breadcrumbs = []): void
    {
        View::composer(['core/base::layouts.partials.breadcrumbs'], function ($view) use ($breadcrumbs) {
            $view->with('breadcrumbs', $breadcrumbs);
        });
    }
}
