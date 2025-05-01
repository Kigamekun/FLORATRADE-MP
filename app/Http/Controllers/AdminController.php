<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Order};
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user')->get(); // semua pesanan
        $totalOrders = $orders->count();
        $totalRevenue = $orders->sum('total_price');
        $ordersByCountry = $orders->groupBy('country')
            ->map(fn($group) => $group->count());

            return view('admin.index', compact('orders','totalOrders','totalRevenue','ordersByCountry'));

    }

    public function chat(Request $request)
    {
        return view('admin.chat');
    }

    public function getSenders(Request $request)
    {
        return response()->json(User::where('id',$request->id)->first()->name, 200);
    }

    public function chatDetail(Request $request,$id)
    {
        $user_id = 1;
        $for_name = User::find($id)->name;
        $from_name = Auth::user()->name;

        return view('chat',['for'=>$id,'user_id'=>$user_id,'for_name'=>$for_name,'from_name'=>$from_name]);
    }


}
