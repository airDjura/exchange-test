<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function index()
    {
        $sourceCurrency = config('currency.source_currency');

        $currencies = \App\Models\Currency::whereNot('name', $sourceCurrency)->get();


        return view('welcome', compact('currencies', 'sourceCurrency'));
    }
}
