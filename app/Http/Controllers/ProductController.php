<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;

use Cartalyst\Stripe\Laravel\Facades\Stripe;

use Illuminate\Http\Request;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);

        $cart = new Cart(session()->get('cart'));

        $cart->updateQty($product->id, $request->qty);

        session()->put('cart', $cart);

        return redirect()->route('showCart')->with('success', '數量金額已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $cart = new Cart(session()->get('cart'));

        $cart->remove($product->id);

        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->route('showCart')->with('success', '此商品已移除');
    }

    public function addToCart(Product $product)
    {

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($product);

        session()->put('cart', $cart);

        return redirect()->route('product.index')->with('success', '此商品已加入購物車');
    }


    public function showCart()
    {

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }

        return view('cart.show', compact('cart'));
    }

    public function checkout($amount)
    {
        return view('cart.checkout', compact('amount'));
    }

    public function charge(Request $request)
    {

        $charge = Stripe::charges()->create([
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'amount' => $request->amount,
            'description' => 'Test from laravel new app',
        ]);

        $chargeId = $charge['id'];

        if ($chargeId) {

            auth()->user()->orders()->create([
                'cart' => serialize(session()->get('cart'))
            ]);


            session()->forget('cart');

            return redirect()->route('order.index')->with('success', " Payment was done. Thanks");
        } else {
            return redirect()->back();
        }
    }
}
