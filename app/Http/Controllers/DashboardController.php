<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $breadCrumbProps = [];
    //
    public function index()
    {
        $breadCrumbProps = [
            'page_name' => "Dashboard",
            'bread_crumbs' => [
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],
                [
                    'label' => 'Dashboard',
                ],
            ],
        ];

        return view('dashboard.index', compact('breadCrumbProps'));
    }
}
