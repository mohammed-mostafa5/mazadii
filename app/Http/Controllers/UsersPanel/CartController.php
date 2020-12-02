<?php

namespace App\Http\Controllers\UsersPanel;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends AppBaseController
{

    public function cart()
    {
        $cart = Cart::where('user_id', auth()->id())->get();

        // return view('UsersPanel.main.cart', compact('cart'));
        return view('usersPanel.page.cart', compact('cart'));
    }

    public function updateQuantity(Request $request, Cart $cart)
    {
        if ($cart->user_id == auth()->id()) {

            $cart->update(['quantity' => $request->quantity]);

            return  response()->json(['total' => '$ ' . $cart->total]);
        }
    }

    public function addOrRemove($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        $result = [];

        if ($cart) {

            $cart->delete();

            $result = [
                'msg' => 'Deleted From Cart',
                'iconAlert' => 'success',
                'icon' => '<i class="fa fa-shopping-bag text-secondary"></i>',
                'for' => '.count-cart',
                'count' => @count(auth()->user()->cart)
            ];
        } else {

            Cart::create(['user_id' => auth()->id(), 'product_id' => $id, 'quantity' => 1]);

            $result = [
                'msg' => 'Added To Cart',
                'iconAlert' => 'success',
                'icon' => '<i class="fa fa-shopping-bag text-danger"></i>',
                'for' => '.count-cart',
                'count' => @count(auth()->user()->cart)
            ];
        }

        return request()->ajax()
            ? response()->json($result)
            : back()->with(['alertStatus' => 'Your cart is empty', 'icon' => 'success']);
    }
}
