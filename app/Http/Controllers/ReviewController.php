<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class ReviewController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'rate' => 'required|integer|min:1|max:5',
        ]);


        $userId = auth()->id();
        

        // Cek apakah user sudah pernah review produk ini
        $existing = Comment::where('user_id', $userId)
                           ->where('plant_id', $request->plant_id)
                           ->where('order_id',$request->order_id)
                           ->first();

        if ($existing) {
                    return redirect()->back()->with(['message'=>'Anda sudah mengirimkan ulasan untuk produk ini.','status'=>'error']);

        }
        if (is_null($request->plant_id)) {
                    return redirect()->back()->with(['message'=>'Mohon pilih produk untuk direview terlebih dahulu.','status'=>'error']);

        }

        Comment::create([
            'user_id' => $userId,
            'plant_id' => $request->plant_id,
            'order_id' => $request->order_id,
            'comment' => $validated['comment'],
            'rate' => $validated['rate'],
        ]);

               return redirect()->back()->with(['message'=>'Terimakasih atas ulasan anda','status'=>'success']);

    }
}
