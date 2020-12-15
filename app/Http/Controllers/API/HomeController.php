<?php

namespace App\Http\Controllers\API;

use App\Models\Faq;
use App\Models\File;
use App\Models\Page;
use App\Models\User;
use App\Models\Client;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\NewsFeed;
use App\Models\Newsletter;
use App\Helpers\MailsTrait;
use App\Models\FaqCategory;
use App\Models\Photographer;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Models\ProductGallery;
use App\Helpers\HelperFunctionTrait;
use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\ProductReview;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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

    public function updatePersonalInformation(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|numeric',
            "address" => "required|string|min:3|max:191",
        ]);

        $user = auth('api')->user();

        $user->update($data);

        return response()->json(compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = auth('api')->user();
        $password = $request->validate(['password' => 'required|string|min:6|confirmed']);
        if (Hash::check(request('old_password'), $user->password)) {

            $user->update($password);

            return response()->json(['msg',  'success']);
        }

        return response()->json(['msg',  'Wrong old password']);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['msg' => __('lang.logoutMsg')]);
    }

    public function home()
    {
        $sliders = Slider::active()->inOrderToWeb()->get();
        $categories = Category::get();
        $products = Product::where('end_at', '>', now())->limit(9)->get();
        $reviews = ProductReview::where('in_home', 1)->get();

        return response()->json(compact('sliders', 'categories', 'products', 'reviews'));
    }

    public function informations()
    {
        $informations = Information::get();

        $phone = $informations->where('id', 1)->first()->value;
        $phone2 = $informations->where('id', 2)->first()->value;
        $email = $informations->where('id', 3)->first()->value;
        $address = $informations->where('id', 4)->first()->value;

        $social = SocialLink::get();

        $facebook = $social->where('id', 1)->first()->link;
        $twitter = $social->where('id', 2)->first()->link;
        $instagram = $social->where('id', 3)->first()->link;
        $linkedIn = $social->where('id', 4)->first()->link;

        return response()->json(compact('phone', 'phone2', 'email', 'address', 'facebook', 'twitter', 'instagram', 'linkedIn'));
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

        $perPage = request()->filled('per_page') ? request('per_page') : 9;

        $productsQuery = Product::where('end_at', '>', now());

        if ($request->filled('sort') == 'name') {
            $productsQuery->orderBy('name');
        } elseif ($request->filled('sort') == 'date') {
            $productsQuery->orderBy('created_at', 'desc');
        } else {
            $productsQuery->orderBy('created_at');
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
        $product->increment('watched_count', 1);
        $biders = DB::table('product_user')->distinct('user_id')->count('user_id');

        return response()->json(compact('product', 'biders'));
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

    public function dashboard()
    {
        $user = auth('api')->user();
        $userBidsCount = $user->bidItems()->count();
        $winningBidsCount = Product::where('winner_id', $user->id)->count();
        $favouritesCount = $user->favourites()->count();

        return response()->json(compact('userBidsCount', 'winningBidsCount', 'favouritesCount'));
    }

    public function currentUserBids()
    {
        $user = auth('api')->user();
        $current = $user->bidItems()->active()->paginate(20);

        return response()->json(compact('current'));
    }

    public function pendingUserBids()
    {
        $user = auth('api')->user();
        $pending = $user->bidItems()->pending()->paginate(20);

        return response()->json(compact('pending'));
    }

    public function finishedUserBids()
    {
        $user = auth('api')->user();
        $finished = $user->bidItems()->finished()->paginate(20);

        return response()->json(compact('finished'));
    }

    public function upcomingMyBids()
    {
        $user = auth('api')->user();
        $upcoming = $user->products()->inactive()->paginate(10);

        return response()->json(compact('upcoming'));
    }

    public function currentMyBids()
    {
        $user = auth('api')->user();
        $current = $user->products()->active()->paginate(10);

        return response()->json(compact('current'));
    }

    public function pastMyBids()
    {
        $user = auth('api')->user();
        $past = $user->products()->finished()->paginate(10);

        return response()->json(compact('past'));
    }

    public function winningBids(Request $request)
    {
        $productsQuery = Product::where('winner_id', auth('api')->id())->active();

        if ($request->sort == 'name') {
            $productsQuery->orderBy('name');
        } elseif ($request->sort == 'date') {
            $productsQuery->orderBy('approved_at', 'desc');
        } else {
            $productsQuery->orderBy('approved_at', 'asc');
        }

        if ($request->filled('name')) {
            $productsQuery->where('name', 'like', '%' . request('name') . '%');
        }

        $products = $productsQuery->paginate(10);

        return response()->json(compact('products'));
    }

    public function addOrRemoveFavourites($productId)
    {
        $product = Product::findOrFail($productId);

        $user = auth('api')->user();

        $user->favourites()->toggle($productId);
        $isfav = $product->is_fav;

        return response()->json(['msg' => 'Success', 'isfav' => $isfav]);
    }

    public function myFavourites(Request $request)
    {
        $user = auth('api')->user();
        $myFavouritesQuery = $user->favourites();

        if ($request->sort == 'name') {
            $myFavouritesQuery->orderBy('name');
        } elseif ($request->sort == 'date') {
            $myFavouritesQuery->orderBy('approved_at', 'desc');
        } else {
            $myFavouritesQuery->orderBy('approved_at', 'asc');
        }

        if ($request->filled('name')) {
            $myFavouritesQuery->where('name', 'like', '%' . request('name') . '%');
        }

        $myFavourites = $myFavouritesQuery->paginate(10);


        return response()->json(compact('myFavourites'));
    }

    public function faqs()
    {
        $faqCategories = FaqCategory::get();
        $faqs = Faq::get();

        return response()->json(compact('faqCategories', 'faqs'));
    }

    public function pages($id)
    {
        $page = Page::find($id);

        return response()->json(compact('page'));
    }

    public function addReview(Request $request, $product_id)
    {
        $product = Product::find($product_id);
        $validated = $request->validate([
            'comment' => 'required|string|min:3',
        ]);
        $validated['user_id'] = auth('api')->id();
        $validated['product_id'] = $product_id;
        $validated['user_type'] = $product->user_id == $validated['user_id'] ? 0 : 1;

        $review = ProductReview::create($validated);

        return response()->json(compact('review'));
    }

    public function chargeBalance(Request $request)
    {
        $user = auth('api')->user();
        $validated = $request->validate([
            'value' => 'required'
        ]);

        $validated['user_id'] = $user->id;
        $validated['action'] = 1;

        $transaction = $user->transactions()->create($validated);

        $user->increment('balance', $validated['value']);

        return response()->json(compact('transaction'));
    }

    public function transactions()
    {
        $user = auth('api')->user();
        $transactions = $user->transactions()->paginate(10);

        return response()->json(compact('transactions'));
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
