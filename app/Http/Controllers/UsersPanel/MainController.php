<?php

namespace App\Http\Controllers\UsersPanel;

use Auth;

use Flash;
use Response;
use App\Models\Area;
use App\Models\User;
use App\Models\Company;
use App\Models\Product;
use App\Models\Pharmacy;
use App\Models\Wishlist;
use App\Models\Appointment;
use App\Models\Distributor;
use Illuminate\Http\Request;
use App\Models\AppointmentPeriod;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\AppBaseController;

class MainController extends AppBaseController
{

    public function dashboard()
    {
        $user = User::find(auth()->id());

        return view('usersPanel.page.dashboard', compact('user'));
    }

    public function profile()
    {
        $user = User::find(auth()->id());
        return view('usersPanel.page.profile.profile', compact('user'));
    }

    // Setting Profile ////////////////////////////

    // Change Email
    public function changeEmail()
    {
        $user = auth()->user();
        return view('usersPanel.page.profile.change-email', compact('user'));
    }

    public function updateEmail(Request $request)
    {
        $email = $request->validate(['email' => 'required|email']);

        $user = auth()->user();
        $email['email_verified_at'] = null;
        $user->update($email);
        event(new Registered($user));

        Flash::success(__('messages.updated', ['model' => __('models/users.fields.email')]));
        return back();
    }

    // Change Password
    public function changePassword()
    {
        $user = auth()->user();
        return view('usersPanel.page.profile.change-password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $password = $request->validate(['password' => 'required|string|min:6|confirmed']);
        if (Hash::check(request('old_password'), $user->password)) {

            $user->update($password);

            Flash::success(__('messages.updated', ['model' => __('models/users.fields.password')]));

            return back();
        }

        Flash::error(__('messages.incorrect', ['model' => __('models/users.fields.old_password')]));

        return back();
    }

    // Personal Information
    public function personalInformation()
    {
        $user = auth()->user();
        $areas = Area::get();

        return view('usersPanel.page.profile.personal-information', compact('user', 'areas'));
    }

    public function updatePersonalInformation(Request $request)
    {
        $data = $request->validate([
             'photo' => 'image|mimes:jpeg,jpg,png',
             'phone' => 'required|numeric',
             "name" => "required|string|min:3|max:191",
             "address" => "required|string|min:3|max:191",
             "area_id" => "required",
            //  "about_me" => "required|string|min:3|max:191",
            //  "gender" => "required|string|min:3|max:191",
        ]);

        $user = auth()->user();

        $user->update($data);

        Flash::success(__('messages.updated', ['model' => __('models/users.fields.basic_information')]));
        return back();
    }

    // End Setting Profile ////////////////////////////

    public function appointments(Request $request)
    {
        // $appointments = AppointmentPeriod::where('user_id', auth()->id())->latest()->get();

        $query = AppointmentPeriod::query();

        if( request()->filled('date')){

            $query->whereIn('appointment_id', function ($q){
                $q->select('id')
                ->from(with(new Appointment)->getTable())
                ->where('date', request('date'));
            });
        }

        $appointments = $query->where('user_id', auth()->id())->latest()->get();

        return view('usersPanel.page.appointment', compact('appointments'));
    }

    public function addToWishlistOrRemoveVet($id)
    {

        $user_id = auth()->id();
        $vet_id = $id;
        $msg = 'fail';
        $status = 403;

        $wishlist = Wishlist::where('user_id', $user_id)
            ->where('wishlistable_id', $vet_id)
            ->where('wishlistable_type', 'App\Models\Vet')
            ->first();

        if ($wishlist)
        {
            $wishlist->delete();
            $msg = 'Deleted from Wishlist';

        } else {

            Wishlist::create(['user_id' => $user_id, 'wishlistable_id' => $vet_id, 'wishlistable_type' => 'App\Models\Vet']);
            $msg = 'Added to Wishlist';
        }

        return back()->with(['alertStatus' => $msg, 'iconAlert' => 'success']);
    }




    public function approval()
    {
        return view('approval');
    }
}
