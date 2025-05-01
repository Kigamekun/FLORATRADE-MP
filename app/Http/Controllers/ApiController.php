<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\{Order,Cart,Plant};
class ApiController extends Controller
{
    public function count_cart(Request $request)
    {
        if (Auth::check()) {
            return response()->json(['count' => Cart::where('user_id',Auth::user()->id)->count()]);
        }else {
            dd(json_decode(Cookie::get('cart'),TRUE));
            $cart = 'x';
            return response()->json(['count' => 1], 200);
        }
    }
}
