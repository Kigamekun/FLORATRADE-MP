<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController,FaqController,InvoiceController,BannerController,UserController,TermsController,StripePaymentController,PricingController,ShippingController,MarketController,VoucherController, PlantController, OrderController,PlantsController};
use App\Models\{User,Cart,Plant,Order};
use Illuminate\Http\Request;
use PayPal\Api\{Item,Payer,Amount,Details,Payment,ItemList,WebProfile,InputFields,Transaction,RedirectUrls,PaymentExecution};
use Illuminate\Support\Facades\Auth;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Menambahkan route untuk products.index
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/profile', function () {
    return view('auth.profile');
})->middleware(['auth'])->name('profile');

Route::post('/edit-user', function (Request $request) {
    User::where('id',Auth::id())->update(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'address'=>$request->address]);
    return redirect()->back()->with(['message'=>'Profile Updated Successfully']);
})->middleware(['auth'])->name('edit-user');

Route::post('/change-thumb', function (Request $request) {
    $request->validate([
        'thumb' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ],['required'=>'File gambar diperlukan','mimes'=>'Format file harus sesuai','image'=>'File harus berupa foto']);




    $file = $request->file('thumb');
    $thumbname = time() . '-' . $file->getClientOriginalName();
    $file->move(public_path() . '/thumb' . '/', $thumbname);


    User::where('id', Auth::id())->update([
        'thumb' => URL::to('/') . '/thumb' . '/' . $thumbname
    ]);

    return redirect()->back()->with(['message' => 'Image has been changed']);
})->middleware(['auth'])->name('change-thumb');

Route::post('/change-password', function (Request $request) {

    $user =  User::where('id',Auth::id())->first();


    if (Hash::check($request->old_password, $user->password)) {
        User::where('id',Auth::id())->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with(['message'=>'Password Changed Successfully']);
    } else {
        return redirect()->back()->with(['message'=>'Old Password is not correct']);
    }

    return redirect()->back()->with(['message'=>'Profile Updated Successfully']);
})->middleware(['auth'])->name('change-password');


require __DIR__.'/auth.php';


Route::prefix('admin')->name('admin.')->middleware(['auth','checkIsAdmin'])->group(function () {

    Route::get('/', [AdminController::class,'index'])->name('index');

    Route::prefix('plants')->group(function () {
        Route::get('/', [PlantsController::class,'index'])->name('plants.index');
        Route::get('/create', [PlantsController::class,'create'])->name('plants.create');
        Route::post('/store', [PlantsController::class,'store'])->name('plants.store');
        Route::get('/edit/{id}', [PlantsController::class,'edit'])->name('plants.edit');
        Route::put('/update/{id}', [PlantsController::class,'update'])->name('plants.update');
        Route::get('/delete/{id}', [PlantsController::class,'destroy'])->name('plants.delete');
    });

    Route::prefix('plant')->group(function () {
        Route::get('/', [PlantController::class,'index'])->name('plant.index');
        Route::get('/create', [PlantController::class,'create'])->name('plant.create');
        Route::post('/changeStatus', [PlantController::class,'changeStatus'])->name('plant.changeStatus');
        Route::post('/store', [PlantController::class,'store'])->name('plant.store');
        Route::get('/edit/{id}', [PlantController::class,'edit'])->name('plant.edit');
        Route::post('/update/{id}', [PlantController::class,'update'])->name('plant.update');
        Route::get('/delete/{id}', [PlantController::class,'destroy'])->name('plant.delete');
    });

    Route::prefix('voucher')->group(function () {
        Route::get('/', [VoucherController::class,'index'])->name('voucher.index');
        Route::get('/create', [VoucherController::class,'create'])->name('voucher.create');
        Route::post('/store', [VoucherController::class,'store'])->name('voucher.store');
        Route::get('/edit/{id}', [VoucherController::class,'edit'])->name('voucher.edit');
        Route::post('/update/{id}', [VoucherController::class,'update'])->name('voucher.update');
        Route::get('/delete/{id}', [VoucherController::class,'destroy'])->name('voucher.delete');
    });

    Route::prefix('shipping')->group(function () {
        Route::get('/', [ShippingController::class,'index'])->name('shipping.index');
        Route::get('/create', [ShippingController::class,'create'])->name('shipping.create');
        Route::post('/store', [ShippingController::class,'store'])->name('shipping.store');
        Route::get('/edit/{id}', [ShippingController::class,'edit'])->name('shipping.edit');
        Route::post('/update/{id}', [ShippingController::class,'update'])->name('shipping.update');
        Route::get('/delete/{id}', [ShippingController::class,'destroy'])->name('shipping.delete');
    });

    Route::prefix('pricing')->group(function () {
        Route::get('/', [PricingController::class,'index'])->name('pricing.index');
        Route::get('/create', [PricingController::class,'create'])->name('pricing.create');
        Route::post('/store', [PricingController::class,'store'])->name('pricing.store');
        Route::get('/edit/{id}', [PricingController::class,'edit'])->name('pricing.edit');
        Route::post('/update/{id}', [PricingController::class,'update'])->name('pricing.update');
        Route::get('/delete/{id}', [PricingController::class,'destroy'])->name('pricing.delete');
    });

    Route::prefix('terms')->group(function () {
        Route::get('/', [TermsController::class,'index'])->name('terms.index');
        Route::post('/update', [TermsController::class,'update'])->name('terms.update');
    });


    Route::prefix('banner')->group(function () {
        Route::get('/', [BannerController::class,'index'])->name('banner.index');
        Route::get('/create', [BannerController::class,'create'])->name('banner.create');
        Route::post('/store', [BannerController::class,'store'])->name('banner.store');
        Route::get('/edit/{id}', [BannerController::class,'edit'])->name('banner.edit');
        Route::post('/update/{id}', [BannerController::class,'update'])->name('banner.update');
        Route::get('/delete/{id}', [BannerController::class,'destroy'])->name('banner.delete');
    });



    Route::prefix('faq')->group(function () {
        Route::get('/', [FaqController::class,'index'])->name('faq.index');
        Route::get('/create', [FaqController::class,'create'])->name('faq.create');
        Route::post('/store', [FaqController::class,'store'])->name('faq.store');
        Route::get('/edit/{id}', [FaqController::class,'edit'])->name('faq.edit');
        Route::post('/update/{id}', [FaqController::class,'update'])->name('faq.update');
        Route::get('/delete/{id}', [FaqController::class,'destroy'])->name('faq.delete');
    });



    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('user.index');
        Route::get('/create', [UserController::class,'create'])->name('user.create');
        Route::post('/store', [UserController::class,'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class,'edit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class,'update'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class,'destroy'])->name('user.delete');
    });



    Route::prefix('invoice')->group(function () {
        Route::get('/', [InvoiceController::class,'index'])->name('invoice.index');
        Route::get('/create', [InvoiceController::class,'create'])->name('invoice.create');
        Route::post('/store', [InvoiceController::class,'store'])->name('invoice.store');
        Route::get('/shareInvoiceLink/{id}', [InvoiceController::class,'shareInvoiceLink'])->name('invoice.shareInvoiceLink');
        Route::post('/stripePayment', [InvoiceController::class,'stripePayment'])->name('invoice.stripePayment');
        Route::post('/manualPayment', [InvoiceController::class,'manualPayment'])->name('invoice.manualPayment');
        Route::get('/approve/{id}', [InvoiceController::class,'approve'])->name('invoice.approve');
        Route::get('/download/{id}', [InvoiceController::class,'download'])->name('invoice.download');
        Route::post('/addResi/{id}', [InvoiceController::class,'addResi'])->name('invoice.addResi');
        Route::post('/changeStatus', [InvoiceController::class,'changeStatus'])->name('invoice.changeStatus');
        Route::post('/detailOrder', [InvoiceController::class,'detailOrder'])->name('invoice.detailOrder');
        // Route::post('/create_payment', [InvoiceController::class,'create_payment'])->name('invoice.create_payment');
        // Route::post('/execute_payment', [InvoiceController::class,'execute_payment'])->name('invoice.execute_payment');
        Route::get('/edit/{id}', [InvoiceController::class,'edit'])->name('invoice.edit');
        Route::post('/update/{id}', [InvoiceController::class,'update'])->name('invoice.update');
        Route::get('/delete/{id}', [InvoiceController::class,'destroy'])->name('invoice.delete');
    });


    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class,'index'])->name('order.index');
        Route::get('/approve/{id}', [OrderController::class,'approve'])->name('order.approve');
        Route::get('/download/{id}', [OrderController::class,'download'])->name('order.download');
        Route::post('/addResi/{id}', [OrderController::class,'addResi'])->name('order.addResi');
        Route::post('/changeStatus', [OrderController::class,'changeStatus'])->name('order.changeStatus');
        Route::post('/detailOrder', [OrderController::class,'detailOrder'])->name('order.detailOrder');
        Route::get('/create', [OrderController::class,'create'])->name('order.create');
        Route::post('/store', [OrderController::class,'store'])->name('order.store');
        Route::get('/edit/{id}', [OrderController::class,'edit'])->name('order.edit');
        Route::post('/update/{id}', [OrderController::class,'update'])->name('order.update');
        Route::get('/delete/{id}', [OrderController::class,'destroy'])->name('order.delete');
    });
    Route::get('/chat', [AdminController::class,'chat'])->name('chat');
    Route::get('/chat/{id}', [AdminController::class,'chatDetail'])->name('chatDetail');
    Route::get('/getSenders', [AdminController::class,'getSenders'])->name('getSenders');


});

    Route::get('/my-cart', [MarketController::class,'my_cart'])->name('my-cart');
    Route::post('/add-to-cart/{id}', [MarketController::class,'add_to_cart'])->name('add-to-cart');
    Route::get('/detail-plant/{id}', [MarketController::class,'detailPlant'])->name('detail-plant');
    Route::post('/increase', [MarketController::class,'increase'])->name('increase');
    Route::post('/decrease', [MarketController::class,'decrease'])->name('decrease');
    Route::get('/delete-cart/{id}', [MarketController::class,'delete_cart'])->name('delete-cart');
    Route::get('/delete-cart-all', [MarketController::class,'delete_cart_all'])->name('delete-cart-all');
    Route::match(['GET','POST'],'/search', [MarketController::class,'search'])->name('search');
    Route::post('/checkout', [MarketController::class,'checkout'])->name('checkout');
    Route::get('/checkout-page', [MarketController::class,'checkout_page'])->name('checkout-page');
    Route::get('/chat/{for}', [MarketController::class,'chat'])->middleware('auth')->name('chat');
    Route::post('/use-voucher', [MarketController::class,'useVoucher'])->name('use-voucher');

    Route::get('/count-cart', [MarketController::class,'count_cart'])->name('count-cart');
    Route::post('/add-address', [MarketController::class,'addAddress'])->name('add-address');
    Route::get('/remove-address', [MarketController::class,'removeAddress'])->name('remove-address');
    Route::get('/more', [MarketController::class,'selengkapnya'])->name('more');
    Route::get('/catalog', [MarketController::class,'catalog'])->name('catalog');
    Route::get('/faq', [MarketController::class,'faq'])->name('faq');
    Route::get('/terms', [MarketController::class,'terms'])->name('terms');
    Route::get('/catalog', [MarketController::class,'catalog'])->name('catalog');

    Route::get('/history-transaction', [MarketController::class,'historyTransaksi'])->name('history-transaction');
    Route::post('/buy', [MarketController::class,'buy'])->name('buy');
    Route::post('/add-bukti-pembayaran', [MarketController::class,'addBuktiPembayaran'])->name('add-bukti-pembayaran');

    Route::post('/get-info-manual-transaction', [MarketController::class,'getInfoManualTransaction'])->name('get-info-manual-transaction');
    Route::post('/get-detail-item-transaction', [MarketController::class,'getDetailItemTransaction'])->name('get-detail-item-transaction');
    Route::get('/transaction', function ()
    {
        return view('transaction');
    })->name('transaction');

    Route::get('/autocomplete-search', [MarketController::class, 'autocompleteSearch']);
    Route::get('/marga-search', [MarketController::class, 'margaSearch']);
    Route::get('/cancel-payment-paypal', [MarketController::class, 'cancelPaymentPaypal'])->name('cancel-payment-paypal');
    Route::post('/getPaypallCreateOrder', [MarketController::class, 'getPaypallCreateOrder'])->name('getPaypallCreateOrder');
    Route::get('/autocomplete-search-tanaman', [MarketController::class, 'autocompleteSearchTanaman']);





Route::post('create-payment', function (Request $request) {

    // ✅ Validasi input
    if (!is_string($request->checkoutInformation) || empty($request->checkoutInformation)) {
        return response()->json(['error' => 'Invalid checkout information'], 400);
    }

    parse_str(urldecode($request->checkoutInformation), $checkoutInfo);
    $shipping = explode('-', $request->ship);

    $info = $checkoutInfo;
    $item = array_filter(explode('|', $info['item']));

    // ✅ Cek apakah user login atau buat akun baru
    if ($request->userId == NULL) {
        $name = explode(' ', $info['name']);
        $img = "https://ui-avatars.com/api/?name=" . ($name[0] ?? '') . "+" . ($name[1] ?? '') . "&color=7F9CF5&background=EBF4FF";

        $cart = json_decode(Cookie::get('cart'), true) ?? [];
        $new_item = [];

        $user = User::create([
            'name' => $info['name'],
            'email' => $info['email'],
            'thumb' => $img,
            'password' => Hash::make($info['password']),
            'address' => $info['address'],
            'phone' => $info['phone'],
        ]);

        Auth::login($user);

        foreach ($item as $value) {
            if (isset($cart[$value])) {
                $cartsId = Cart::insertGetId([
                    'user_id' => Auth::user()->id,
                    'plant_id' => $value,
                    'qty' => $cart[$value]['qty'],
                    'total' => Plant::find($value)->price * $cart[$value]['qty'],
                    'has_paid' => false,
                ]);
                $new_item[] = $cartsId;
            }
        }
        $item = $new_item;
    } else {
        $user = User::find($request->userId);
    }

    $kode_transaksi = 'MTPLC-PLT-#' . Str::upper(Str::random(10) . '-' . time());

    // ✅ Cek diskon voucher
    $voucher = DB::table('vouchers')->where('code', $info['voucher_code'])->first();
    $disc = $voucher ? $voucher->disc : 0;

    // ✅ Setup PayPal API Context
    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            env('PAYPAL_SANDBOX_CLIENT_ID'),
            env('PAYPAL_SANDBOX_CLIENT_SECRET')
        )
    );

    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

    $total = 0;
    $all_item = [];

    foreach ($item as $value) {
        $cartItem = Cart::find($value);
        if ($cartItem) {
            $plant = Plant::find($cartItem->plant_id);

            if ($plant) {
                $price = ($cartItem->total / $cartItem->qty) - (($cartItem->total / $cartItem->qty) * $disc / 100);
                $subitem = new Item();
                $subitem->setName($plant->name)
                    ->setCurrency('USD')
                    ->setQuantity($cartItem->qty)
                    ->setSku($cartItem->id . $plant->id . $cartItem->qty)
                    ->setPrice($price);

                $total += $price * $cartItem->qty;
                $all_item[] = $subitem;
            }
        }
    }

    // ✅ Pastikan $all_item tidak kosong sebelum setItems()
    if (empty($all_item)) {
        return response()->json(['error' => 'Cart is empty'], 400);
    }

    if (!is_array($all_item) || empty($all_item)) {
        return response()->json(['error' => 'Cart is empty or invalid'], 400);
    }

    $itemList = new ItemList();
    $itemList->setItems(array_values($all_item)); // Pastikan array valid


    $details = new Details();
    $details->setShipping($shipping[1])
        ->setTax($total * 0.05)
        ->setSubtotal($total);

    $amount = new Amount();
    $amount->setCurrency("USD")
        ->setTotal($total + $shipping[1] + ($total * 0.05))
        ->setDetails($details);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription("Payment description")
        ->setInvoiceNumber(uniqid());

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl(route('my-cart'))
        ->setCancelUrl(route('cancel-payment-paypal'));

    // ✅ Setup NO SHIPPING option
    $inputFields = new InputFields();
    // $inputFields->setNoShipping(1);

    $webProfile = new WebProfile();
    $webProfile->setName(env('APP_NAME') . uniqid())->setInputFields($inputFields);

    $webProfileId = $webProfile->create($apiContext)->getId();

    $payment = new Payment();
    $payment->setExperienceProfileId($webProfileId);
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);

    try {
        $payment->create($apiContext);
    } catch (\Exception $ex) {
        return response()->json(['error' => $ex->getMessage()], 500);
    }

    return response()->json([
        'id' => $payment->getId(),
        'new_item' => implode("|", $item),
    ]);
})->name('create-payment');





Route::post('execute-payment', function (Request $request) {
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            env('PAYPAL_SANDBOX_CLIENT_ID'),     // ClientID
            env('PAYPAL_SANDBOX_CLIENT_SECRET')      // ClientSecret
        )
    );


    $paymentId = $request->paymentID;
    $payment = Payment::get($paymentId, $apiContext);

    $shipping = explode('-',$request->ship);

    $execution = new PaymentExecution();
    $execution->setPayerId($request->payerID);

    try {
        $result = $payment->execute($execution, $apiContext);
    } catch (Exception $ex) {
        echo $ex;
        exit(1);
    }

    parse_str(urldecode($request->checkoutInformation),$checkoutInfo);
    $info = $checkoutInfo;

    $user = User::where('id',Auth::id())->first();

    $kode_transaksi = 'MTPLC-PLT-#'.Str::upper(Str::random(3).time());


    if (!is_null(DB::table('vouchers')->where('code',$info['voucher_code'])->first())) {
        $disc = DB::table('vouchers')->where('code',$info['voucher_code'])->first()->disc;
        $id = Order::insertGetId([
            'user_id' => $user->id,
            'kode_transaksi' => $kode_transaksi,
            'date'=>date('Y-m-d'),
            'total_price' => $info['total'],
            'total_price_after_disc' => $info['total'] - ($info['total'] * $disc/100),
            'tax' => ($info['total'] - ($info['total'] * $disc/100)) * 5/100,
            'status' => 1,
            'payment_method' => 2,
            'currency'=>"USD",
            'hasPaid'=>0,
            'discount' => $disc,
            'discount_code' => $info['voucher_code'],
            'nama_penerima' => $user->name,
            'alamat_penerima' => $info['address'],
            'email_penerima' => $user->email,
            'negara_tujuan' => $info['country'],
            'provinsi_tujuan' => $info['province'],
            'kota_tujuan' => $info['city'],
            'zipcode' => $info['zipcode'],
            'shipping_method' => $shipping[0],
            'shipping_price' => $shipping[1]
        ]);

    }

    else {
        $id = Order::insertGetId([
            'user_id' => $user->id,
            'kode_transaksi' => $kode_transaksi,
            'date'=>date('Y-m-d'),
            'total_price' => $info['total'],
            'total_price_after_disc' => $info['total'],
            'tax' => $info['total'] * 5/100,
            'status' => 1,
            'payment_method' => 2,
            'currency'=>"USD",
            'hasPaid'=>0,
            'discount' => 0,
            'discount_code' => NULL,
            'nama_penerima' => $user->name,
            'alamat_penerima' => $info['address'],
            'email_penerima' => $user->email,
            'negara_tujuan' => $info['country'],
            'provinsi_tujuan' => $info['province'],
            'kota_tujuan' => $info['city'],
            'zipcode' => $info['zipcode'],
            'shipping_method' => $shipping[0],
            'shipping_price' => $shipping[1]
        ]);
    }

    $item = explode('|',$info['item']);
    $item = array_filter($item);
        foreach ($item as $key => $value) {
            Cart::where('id',$value)->update(['order_id'=>$id]);
            $itm = Cart::where('id',$value)->first();
            Plant::where('id',$itm->plant_id)->decrement('stock', $itm->qty);

        }
    Cookie::queue(Cookie::forget('cart'));

    return $result;
})->name('execute-payment');


Route::get('stripe', [StripePaymentController::class, 'stripe']);

Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
Route::post('/getStripeCheckout', [StripePaymentController::class, 'getStripeCheckout'])->name('getStripeCheckout');
Route::post('/payStripe', [StripePaymentController::class, 'payStripe'])->name('payStripe');

Route::get('/about', function () {
    return view('user.about');
});

