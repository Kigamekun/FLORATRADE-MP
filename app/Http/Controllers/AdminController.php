<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Order, Plant,Cart};
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user')->get();
        $plants = Plant::with('category')->get();

        // Data untuk chart status pesanan
        $orderStatuses = Order::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Data untuk peta
        $mapOrders = Order::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        // Data revenue bulanan
        $monthlyRevenue = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, sum(total_price_after_disc) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();


            $chartData = [
                'labels' => $plants->map(function($plant) {
                    return $plant->name . ' (' . $plant->category->name . ')';
                })->toArray(),
                'stocks' => $plants->pluck('stock')->toArray(),
                'colors' => $plants->map(function($plant) {
                    return $plant->stock < 10 ? '#e74a3b' : '#4e73df';
                })->toArray()
            ];

            $paymentMethods = Order::selectRaw('payment_method, count(*) as count')
            ->groupBy('payment_method')
            ->get()
            ->mapWithKeys(function($item) {
                $methods = [
                    1 => 'Manual',
                    2 => 'PayPal',
                    3 => 'Stripe'
                ];
                return [
                    $methods[$item->payment_method] => $item->count
                ];
            });


            $bestSellingPlants = Cart::selectRaw('plant_id, sum(qty) as total_sold, sum(total) as total_revenue')
            ->with('plant.category')
            ->groupBy('plant_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get()
            ->map(function($cart) {
                return [
                    'name' => $cart->plant->name,
                    'category' => $cart->plant->category->name,
                    'sold' => $cart->total_sold,
                    'revenue' => $cart->total_revenue,
                    'image' => $cart->plant->thumb
                ];
            });


            $stock = Plant::with('category')
            ->orderBy('stock', 'asc')
            ->paginate(5); // Sesuaikan jumlah item per halaman

            $Pm = Order::select('payment_method')
            ->selectRaw('count(*) as count')
            ->groupBy('payment_method')
            ->get();

        $totalOrders = Order::count();

        // Mapping payment method
        $paymentData = [
            'Credit Card' => [
                'methods' => [3], // Sesuaikan dengan ID payment method di database
                'subtext' => ' Manual Payment',
                'count' => 0
            ],
            'Digital Wallet' => [
                'methods' => [2],
                'subtext' => 'PayPal Payment',
                'count' => 0
            ],
            'Bank Transfer' => [
                'methods' => [1],
                'subtext' => 'STRIPE Payment',
                'count' => 0
            ],
            'Others' => [
                'methods' => [],
                'subtext' => 'Cash on delivery, etc.',
                'count' => 0
            ]
        ];

        // Hitung jumlah per kategori
        foreach ($Pm as $pm) {
            foreach ($paymentData as $category => $data) {
                if (in_array($pm->payment_method, $data['methods'])) {
                    $paymentData[$category]['count'] += $pm->count;
                }
            }
        }

        // Hitung others
        $usedMethods = array_merge(
            $paymentData['Credit Card']['methods'],
            $paymentData['Digital Wallet']['methods'],
            $paymentData['Bank Transfer']['methods']
        );

        $paymentData['Others']['count'] = $totalOrders - array_sum(array_column($paymentData, 'count'));

        // Hitung persentase
        foreach ($paymentData as $category => $data) {
            $paymentData[$category]['percentage'] = $totalOrders > 0
                ? round(($data['count'] / $totalOrders) * 100, 1)
                : 0;
        }

        // Hitung jumlah produk di bawah threshold
        $lowStockCount = Plant::where('stock', '<', 10)->count();

        $topCountry = Order::select('negara_tujuan')
        ->selectRaw('count(*) as total')
        ->groupBy('negara_tujuan')
        ->orderByDesc('total')
        ->first();

    $topCity = Order::select('kota_tujuan')
        ->selectRaw('count(*) as total')
        ->groupBy('kota_tujuan')
        ->orderByDesc('total')
        ->first();

    $totalInternational = Order::where('negara_tujuan', '!=', 'Indonesia')->count();
    $totalOrders = Order::count();
    $internationalPercentage = $totalOrders > 0 ? round(($totalInternational / $totalOrders) * 100, 2) : 0;

    $newMarkets = Order::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->distinct('negara_tujuan')
        ->count('negara_tujuan');

    $prevMonthMarkets = Order::whereMonth('created_at', now()->subMonth()->month)
        ->whereYear('created_at', now()->year)
        ->distinct('negara_tujuan')
        ->count('negara_tujuan');

    $newMarketsCount = $newMarkets - $prevMonthMarkets;

    // Stat Cards
    $currentMonthOrders = Order::whereMonth('created_at', now()->month)->count();
    $prevMonthOrders = Order::whereMonth('created_at', now()->subMonth()->month)->count();
    $orderGrowth = $prevMonthOrders > 0 ? round((($currentMonthOrders - $prevMonthOrders) / $prevMonthOrders) * 100, 1) : 0;

    $currentRevenue = Order::where('hasPaid', 1)->whereMonth('created_at', now()->month)->sum('total_price_after_disc');
    $prevRevenue = Order::where('hasPaid', 1)->whereMonth('created_at', now()->subMonth()->month)->sum('total_price_after_disc');
    $revenueGrowth = $prevRevenue > 0 ? round((($currentRevenue - $prevRevenue) / $prevRevenue) * 100, 1) : 0;

    $totalCompletedOrders = Order::where('hasPaid', 1)->count();
    $totalCarts = Cart::count();
    $conversionRate = $totalCarts > 0 ? round(($totalCompletedOrders / $totalCarts) * 100, 2) : 0;

    $avgOrderValue = $totalCompletedOrders > 0 ? round($currentRevenue / $totalCompletedOrders, 2) : 0;



        return view('admin.index', compact('orders',
        'topCountry',
        'topCity',
        'internationalPercentage',
        'newMarketsCount',
        'currentMonthOrders',
        'orderGrowth',
        'currentRevenue',
        'revenueGrowth',
        'conversionRate',
        'avgOrderValue',
        'paymentData', 'plants','bestSellingPlants','stock','lowStockCount','paymentMethods','chartData', 'orderStatuses', 'mapOrders', 'monthlyRevenue'));
    }

    public function chat(Request $request)
    {
        return view('admin.chat');
    }

    public function getSenders(Request $request)
    {
        return response()->json(User::where('id', $request->id)->first()->name, 200);
    }

    public function chatDetail(Request $request, $id)
    {
        $user_id = 1;
        $for_name = User::find($id)->name;
        $from_name = Auth::user()->name;

        return view('chat', ['for' => $id, 'user_id' => $user_id, 'for_name' => $for_name, 'from_name' => $from_name]);
    }


}
