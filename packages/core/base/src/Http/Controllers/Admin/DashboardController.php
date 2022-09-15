<?php

namespace Messi\Base\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('core/base::dashboard.index');
    }
}
