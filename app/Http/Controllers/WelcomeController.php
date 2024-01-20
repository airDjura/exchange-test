<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function index()
    {
        $currencies = \App\Models\Currency::whereNot('name', 'USD')->get();

        return view('welcome', compact('currencies'));
    }
}
