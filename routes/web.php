<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $breadCrumbProps = [
        'page_name' => "Home Page",
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
    return view('layouts.app', compact('breadCrumbProps'));
})->name('home');
