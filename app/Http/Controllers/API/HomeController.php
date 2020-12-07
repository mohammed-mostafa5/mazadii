<?php

namespace App\Http\Controllers\API;

use App\Models\File;
use App\Models\User;
use App\Models\Client;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\NewsFeed;
use App\Models\Newsletter;
use App\Helpers\MailsTrait;
use App\Models\Photographer;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Helpers\HelperFunctionTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Ui\Presets\React;

class HomeController extends Controller
{
    use HelperFunctionTrait, MailsTrait;

    public function test()
    {
        return ('test home');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['msg' => __('lang.wrongCredential')], 401);
        } else {
            $user = auth('api')->user();
            if ($user->status == 'Inactive') {
                return response()->json(['msg' => __('lang.notActive')], 403);
            }
            if (!$user->approved_at) {
                return response()->json(['msg' => __('lang.notApproved')], 403);
            }
        }

        $user = auth('api')->user();

        return response()->json(compact('user', 'token'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required',
            'identification' => 'required|image',
        ]);

        $user = User::create($request->all());

        return response()->json(['msg' => 'ok']);
    }

    public function home()
    {
        $sliders = Slider::active()->inOrderToWeb()->get();
        $categories = Category::get();
        $products = Product::approved()->active()->limit(9)->get();

        return response()->json(compact('sliders', 'categories', 'products'));
    }

    public function sendContactMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:191',
            'email' => 'required|email|min:3|max:191',
            'phone' => 'required',
            'message' => 'required|string|min:3',
        ]);
        Contact::create($validated);

        return response()->json(['msg' => 'success']);
    }

    public function newsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|min:3|max:191|unique:newsletters,email',
        ]);
        Newsletter::create($validated);

        return response()->json(['msg' => 'success']);
    }

    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'start_bid_price' => 'required',
            'min_bid_price' => 'required',
            'category_id' => 'required',
            'photos' => 'required|array|min:6',
            'photos.*' => 'image',
        ]);

        $validated['user_id'] = auth('api')->id();
        $product = Product::create($validated);

        foreach ($request->photos as $photo) {

            ProductGallery::create([
                'product_id' => $product->id,
                'photo' => $photo
            ]);
        }

        return response()->json(['msg' => 'success']);
    }

    public function categories()
    {
        $categories = Category::get();

        return response()->json(compact('categories'));
    }

    public function products(Request $request)
    {
        $request->validate([
            'sort' => 'in:name,created_at'
        ]);

        $perPage = request()->filled('per_page') ? request('per_page') : 9;

        $productsQuery = Product::active();

        if ($request->filled('sort')) {
            $productsQuery->orderBy(request('sort'));
        }

        if ($request->filled('name')) {
            $productsQuery->where('name', 'like', '%' . request('name') . '%');
        }

        if ($request->filled('category_id')) {
            $productsQuery->where('category_id', request('category_id'));
        }

        $products = $productsQuery->paginate($perPage);

        return response()->json(compact('products'));
    }

    public function product($id)
    {
        $product = Product::with('category', 'biders')->findOrFail($id);

        return response()->json(compact('product'));
    }


    public function addBid(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->end_at < now()) {
            return response()->json(['msg' => __('lang.auctionEnded')], 420);
        }

        $user = auth('api')->user();
        $highestValue = $product->highest_value ?? $product->start_bid_price;
        $minBid = $highestValue + $product->min_bid_price;

        $request->validate([
            'value' => 'required|integer|min:' . $minBid,
        ]);

        $product->biders()->attach($user->id, ['value' => request('value')]);
        $product->update(['highest_value' => request('value'), 'winner_id' => $user->id]);
        $biders = $product->biders;

        return response()->json(compact('biders'));
    }


    public function logout()
    {
        auth('api')->logout();

        return response()->json(['msg' => __('lang.logoutMsg')]);
    }






















    public function sendCodeToUser(Request $request)
    {
        $email = $request->validate(['email' => 'required|email']);

        $user = User::where('email', $email)->first();

        if ($user) {

            $user->update(['verify_code' => $this->randomCode(4)]);

            $this->sendCodeToMail($user->email, $user->verify_code);

            return response()->json(['msg' => 'success', 'verify_code' => $user->verify_code]);
        }

        return response()->json(['msg' => 'fail'], 403);
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['verify_code' => 'required|min:4|max:5']);

        $user = User::where('verify_code', $request->verify_code)->first();


        if ($user) {

            $user->update(['email_verified_at' => now()]);
            return response()->json(['msg' => 'success']);
        }

        return response()->json(['msg' => 'fail']);
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            'verify_code' => 'required|min:4|max:5',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::where('verify_code', $request->verify_code)->first();


        if ($user) {

            $user->update([

                'email_verified_at' => now(),
                'verify_code' => null,
                'password' => $request->password
            ]);

            return response()->json(['msg' => 'success']);
        }

        return response()->json(['msg' => 'fail']);
    }
}
