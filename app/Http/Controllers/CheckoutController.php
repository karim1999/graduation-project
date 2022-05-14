<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request){
        $price = 54999;
        $qty = 1;
        return auth()->user()->checkoutCharge($price, 'Moving', $qty);
    }
}
