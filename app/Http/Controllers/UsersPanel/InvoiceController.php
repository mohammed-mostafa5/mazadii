<?php

namespace App\Http\Controllers\UsersPanel;


use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;

class InvoiceController extends AppBaseController
{
    public function checkout()
    {

        $products = Cart::where('user_id', auth()->id())->get();

        if (count($products) != 0) {

            // return view('website.checkout', compact('products'));
            return view('usersPanel.page.checkout', compact('products'));
        } else {

            return redirect()->route('UsersPanel.showCart')
                ->with(['alertStatus' => 'Your cart is empty', 'icon' => 'warning']);
        }
    }

    public function couponValidation(Request $request)
    {

        $coupon = Coupon::where('code', $request->code)
            ->where('expired_at', '>', now())
            ->active()
            ->first();


        if ($coupon) {

            return  response()->json(['result' => '<p class="text-success">Valid Coupon</p>', 'type' => '1', 'discount' => $coupon->value]);
        }

        return  response()->json(['result' => '<p class="text-danger">Invalid Coupon</p>', 'type' => '0']);
    }

    public function order(Request $request)
    {
        $request->validate(['checkout_accept_policy' => 'required']);

        try {
            $userID = auth()->id();

            $cart = Cart::where('user_id', $userID)->get();

            $order = Order::create(['user_id' => $userID]);

            if (request()->filled('code')) {

                $coupon = Coupon::where('code', request('code'))->active()->first();

                $order->update(['code' => $coupon->code ?? '', 'value' => $coupon->value ?? '']);
            }

            foreach ($cart as $item) {
                $alltotal = $item->quantity * $item->price;

                $order->products()->syncWithoutDetaching([$item->product_id => ['price' => $item->price, 'quantity' => $item->quantity, 'total' => $alltotal]]);
                $order->increment('alltotal', $alltotal);

                $item->delete();
            }


            return redirect()->route('usersPanel.invoice', $order->id)->with(['alertStatus' => 'Success Order', 'icon' => 'success']);
        } catch (\Throwable $th) {

            return back()->with(['alertStatus' => 'Sorry, an error has occurred, and Order cannot be created now', 'icon' => 'error']);
        }
    }

    public function invoices()
    {
        $orders = Order::where('user_id', auth()->id())->get();

        return view('usersPanel.page.invoice.invoices', compact('orders'));
    }

    public function invoice($id)
    {
        $invoice = Order::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if ($invoice) {
            return view('usersPanel.page.invoice.invoice', compact('invoice'));
        }

        return back();
    }
}
