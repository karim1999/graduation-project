<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request){
        $total = $request->total ?? 1;
        $price = (int) ($total * 100);
        $qty = 1;
        return auth()->user()->checkoutCharge($price, 'Moving', $qty);
    }
}
