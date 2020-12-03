<?php

namespace App\Http\Controllers\API;

use App\Models\File;
use App\Models\User;
use App\Models\Client;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Category;
use App\Models\NewsFeed;
use App\Helpers\MailsTrait;
use App\Models\Photographer;
use Illuminate\Http\Request;
use App\Helpers\HelperFunctionTrait;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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
                return response()->json(['msg' => __('lang.not_active')], 401);
            }
            if (!$user->approved_at) {
                return response()->json(['msg' => __('lang.not_approved')], 401);
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
            'identification' => 'required',
        ]);

        $user = User::create($request->all());

        return response()->json(compact('user', 'token'));
    }

    public function home()
    {
        $sliders = Slider::active()->inOrderToWeb()->get();
        $categories = Category::get();

        return response()->json(compact('sliders', 'categories'));
    }

    public function sendContactMessage(Request $request)
    {
        $validated = $request->validate(Contact::$rules);
        Contact::create($validated);

        return response()->json(['msg' => 'success']);
    }


    public function newsletter(Request $request)
    {
        $validated = $request->validate(Newsletter::$rules);
        Newsletter::create($validated);

        return response()->json(['msg' => 'success']);
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

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => __('lang.logoutMsg')]);
    }
}
