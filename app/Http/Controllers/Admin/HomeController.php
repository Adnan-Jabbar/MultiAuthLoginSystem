<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // dd(\Auth::guard('admin')->user());
        // dd(\Auth::guard('admin')->user()->hasRole('admin'));
        
        return view('admin.dashboard');
    }

    public function adminTest()
    {
        // By using Guard
        // if(\Auth::guard('admin')->user()->hasRole('admin'))
        // {
        //     dd('Only admin allowed');
        // }
        // abort(403);

        // By using Gate
        if(\Gate::forUser(\Auth::guard('admin')->user())->allows('admin'))
        {
            dd('Only admin allowed');
        }
        abort(403);
    }

    public function editorTest()
    {
        // By using Guard
        // if(\Auth::guard('admin')->user()->hasRole('editor'))
        // {
        //     dd('Only editor allowed');
        // }
        // abort(403);

        // By using Gate
        if(\Gate::forUser(\Auth::guard('admin')->user())->allows('editor'))
        {
            dd('Only editor allowed');
        }
        abort(403);
    }



}


