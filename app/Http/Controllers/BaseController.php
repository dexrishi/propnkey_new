<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

abstract class AdminBaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Get the current route name
     */
    protected function getCurrentRoute()
    {
        return request()->route()->getName();
    }

    /**
     * Return view with current route
     */
    protected function viewWithRoute($view, $data = [])
    {
        $data['currentRoute'] = $this->getCurrentRoute();
        return view($view, $data);
    }
}
