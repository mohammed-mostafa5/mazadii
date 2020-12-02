<?php

namespace App\Http\Controllers\API;

use App\Models\Pet;
use App\Models\Vet;
use App\Models\Area;
use App\Models\Cart;
use App\Models\Chat;
use App\Models\City;
use App\Models\Page;
use App\Models\Size;
use App\Models\User;
use App\Models\Brand;
use App\Models\Breed;
use App\Models\Color;
use App\Models\Order;
use App\Models\Style;
use App\Models\Coupon;
use App\Models\Gender;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\PetType;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Delivery;
use App\Models\Magazine;
use App\Models\Wishlist;
use App\Models\VetReview;
use Laracasts\Flash\Flash;
use App\Models\Appointment;
use App\Models\ChatContent;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\AppointmentPeriod;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\PetCollection;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\ProductCollection;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Pet as PetResources;
use App\Http\Resources\Product as ProductResources;
use App\Events\Chat as EventsChat;

class ShopController extends Controller
{



  // Shop ////////////////////////////////////

    public function shop()
    {
        $sliders = Slider::active()->inOrderToMobile()->get();

        $categories = Category::select('id', 'name', 'photo')
        ->parent()
        ->inOrderTOProdcut()
        ->get();

        $categoryWithProducts = Category::select('id', 'name')
            ->inOrderTOProdcut()
            ->parent()
            ->with(['productsCategory' => function ($query) {
                $query->latest()->limit(4);
            }])->get();

        return response()->json(compact('categories', 'categoryWithProducts', 'sliders'));
    }

    public function categories()
    {
        $categories = Category::where('parent_id', null)
            ->inOrderTOProdcut()
            ->get();

        return response()->json(compact('categories'));
    }

    public function subcategories($category_id)
    {
        $subcategories = Category::select('id', 'name', 'photo')
            ->inOrderTOProdcut()
            ->where('parent_id', $category_id)
            ->get();

        return response()->json(compact('subcategories'));
    }

    public function products($category_id)
    {
        $category = Category::select('id', 'name', 'parent_id')->find($category_id);

        $query = Product::query();


        if (!$category->parent_id) {

            $query->whereIn('category_id', Category::select('id')->where('parent_id', $category_id)->pluck('id')->toArray());
        } else {

            $query->where('category_id', $category_id);
        }

        $products = $query->get()->makeHidden([
            'photo_1',
            'photo_2',
            'photo_3',
            'category_id',
            'admin_id',
            'color_id',
            'size_id',
            'style_id',
            'brand_id',
            'weight_id',
            'views',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
            'sku',
            'type',
            'description',
            'translations',
            ]);

        return response()->json(compact('category', 'products'));
    }

    public function product($product_id)
    {
        $product = Product::with('reviews', 'color', 'size', 'style', 'brand', 'weight')
        ->where('id', $product_id)
        ->first()
        ->makeHidden([
            'photo_1',
            'photo_2',
            'photo_3',
            'admin_id',
            'color_id',
            'size_id',
            'style_id',
            'brand_id',
            'weight_id',
            'views',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
            'sku',
            'type',
            'translations',
            ]);

        $relatedProducts = Product::with('reviews')
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->limit(4)
            ->latest()
            ->get()->makeHidden([
                'photo_1',
                'photo_2',
                'photo_3',
                'admin_id',
                'color_id',
                'size_id',
                'style_id',
                'brand_id',
                'weight_id',
                'views',
                'status',
                'created_at',
                'updated_at',
                'deleted_at',
                'sku',
                'type',
                'description',
                'translations',
                ]);

        $delivery = Delivery::first();
        return response()->json(compact('product', 'relatedProducts','delivery'));
    }

  // Shop ////////////////////////////////////

    ####################################################################

  // Cart ////////////////////////////////////

    public function myCart()
    {
        $products = Cart::where('user_id', auth('api')->id())->get();

        $total = $products->sum('total');

        return response()->json(compact('products', 'total'));
    }

    public function updateQuantity(Request $request, Cart $cart)
    {
        if ($cart->user_id == auth('api')->id()) {

            $cart->update(['quantity' => $request->quantity]);

            return  response()->json(['msg' => 'success']);
        }

        return  response()->json(['msg' => 'fail'], 403);
    }

    public function addToCartOrRemove($id)
    {
        $user_id = auth('api')->id();
        $product_id = $id;

        $cart = Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($cart) {

            $cart->delete();
        } else {

            Cart::create(['user_id' => $user_id, 'product_id' => $product_id, 'quantity' => 1]);
        }

        return response()->json(['msg' => 'success']);
    }

  // Cart ////////////////////////////////////

    ####################################################################

  // Order Product ////////////////////////////////////

    public function checkoutLocation()
    {
        $areas = Area::get()->makeHidden([
            'status',
            'city_id',
            'deleted_at',
            'translations',
            ]);

        $user = User::find(auth('api')->id());

        return response()->json(compact('areas', 'user'));
    }

    // public function checkoutUpdateLocation(Request $request)
    // {
    //     $user = User::find(auth('api')->id());

    //     $dataOrder=$request->validate([
    //         'first_name'        =>'required|max:191',
    //         'last_name'         =>'required|max:191',
    //         'phone'             =>'required|max:191',
    //         // 'company'           =>'required|max:191',
    //         'area_id'              =>'required|max:191',
    //         'street_address'    =>'required|max:191',
    //         'partment_number'   =>'required|max:191',
    //     ]);

    //     $user->update($dataOrder);

    //     return  response()->json(['msg' => 'Success Update Location']);
    // }

    public function checkoutProduct(Request $request)
    {
        $products = Cart::where('user_id', auth('api')->id())->get();

        if($products->count() < 1){
            return response()->json(['msg'=>'Your cart is empty'], 403);
        }

        $total = $products->sum('total');

        $dataOrder=$request->validate([
            'first_name'        =>'required|max:191',
            'last_name'         =>'required|max:191',
            'phone'             =>'required|max:191',
            // 'company'           =>'required|max:191',
            'area_id'              =>'required|max:191',
            'street_address'    =>'required|max:191',
            'partment_number'   =>'required|max:191',
        ]);

        if(request()->filled('set_default') && request('set_default') == 1){

            $user = auth('api')->user();

            $user->update($dataOrder);

        }
        $area = Area::find(request('area_id'));

        $delivery_fee = City::find($area->city_id)->delivery_fee;
        $dataOrder['area']=$area->text;
        return response()->json(compact('total', 'delivery_fee', 'user', 'dataOrder'));
    }

    public function orderProduct(Request $request)
    {
        try {

            $userID = auth('api')->id();

            $cart = Cart::where('user_id', $userID)->get();

            if(count($cart) < 1){
                return response()->json(['msg'=>'Your cart is empty'], 403);
            }

            $dataOrder=$request->validate([
                'first_name'        =>'required|max:191',
                'last_name'         =>'required|max:191',
                'phone'             =>'required|max:191',
                // 'company'           =>'required|max:191',
                'area_id'              =>'required|max:191',
                'street_address'    =>'required|max:191',
                'partment_number'   =>'required|max:191',
            ]);


            $dataOrder['user_id'] = $userID;

            $order = Order::create($dataOrder);

            // $user = User::find($userID);
            // $order = Order::create([
            //     'user_id'              =>$userID,
            //     'first_name'           =>$user->first_name,
            //     'last_name'            =>$user->last_name,
            //     'phone'                =>$user->phone,
            //     // 'company'           =>$user->first_name,
            //     'area_id'              =>$user->area->name,
            //     'street_address'       =>$user->street_address,
            //     'partment_number'      =>$user->partment_number,
            // ]);


            if (request()->filled('code')) {

                $coupon = Coupon::where('code', request('code'))->active()->first();

                if($coupon){

                    $order->update(['code' => $coupon->code ?? '', 'value' => $coupon->value ?? '']);
                }
            }

            foreach ($cart as $item) {
                $alltotal = $item->quantity * $item->price;

                $order->products()->syncWithoutDetaching([$item->product_id => ['price' => $item->price, 'quantity' => $item->quantity, 'total' => $alltotal]]);
                $order->increment('alltotal', $alltotal);

                $item->delete();
            }

            return  response()->json(['msg' => 'Success Order']);

        } catch (\Throwable $th) {

            return  response()->json(['msg' => 'Sorry, an error has occurred, and Order cannot be created now'], 403);
        }

    }

    public function myOrders()
    {
        $orders = Order::where('user_id', auth('api')->id())
        // ->with('products')
        ->get();

        return response()->json(compact('orders'));
    }

    public function myOrder($id)
    {
        $orders = Order::where('user_id', auth('api')->id())
        ->with('products')
        ->find($id);

        return response()->json(compact('orders'));
    }

  // Order Product ////////////////////////////////////

    ####################################################################

  // Wishlist /////////////////////////////////

    public function addToWishlistOrRemoveProduct($id)
    {
        $user_id = auth('api')->id();
        $product_id = $id;
        $msg = 'fail';
        $status = 403;

        $wishlist = Wishlist::where('user_id', $user_id)
            ->where('wishlistable_id', $product_id)
            ->where('wishlistable_type', 'App\Models\Product')
            ->first();

        if ($wishlist) {

            $wishlist->delete();
            $msg = 'success';
            $status = 200;

        } else {

            Wishlist::create(['user_id' => $user_id, 'wishlistable_id' => $product_id, 'wishlistable_type' => 'App\Models\Product']);

            $msg = 'success';
            $status = 200;
        }

        return response()->json(['msg' => $msg], $status);
    }

    public function addToWishlistOrRemoveVet($id)
    {

        $user_id = auth('api')->id();
        $product_id = $id;
        $msg = 'fail';
        $status = 403;

        $wishlist = Wishlist::where('user_id', $user_id)
            ->where('wishlistable_id', $product_id)
            ->where('wishlistable_type', 'App\Models\Vet')
            ->first();

        if ($wishlist) {

            $wishlist->delete();
            $msg = 'success';
            $status = 200;

        } else {

            Wishlist::create(['user_id' => $user_id, 'wishlistable_id' => $product_id, 'wishlistable_type' => 'App\Models\Vet']);

            $msg = 'success';
            $status = 200;
        }

        return response()->json(['msg' => $msg], $status);
    }

    public function addToWishlistOrRemovePet($id)
    {

        $user_id = auth('api')->id();
        $product_id = $id;
        $msg = 'fail';
        $status = 403;

        $wishlist = Wishlist::where('user_id', $user_id)
            ->where('wishlistable_id', $product_id)
            ->where('wishlistable_type', 'App\Models\Pet')
            ->first();

        if ($wishlist) {

            $wishlist->delete();
            $msg = 'success';
            $status = 200;

        } else {

            Wishlist::create(['user_id' => $user_id, 'wishlistable_id' => $product_id, 'wishlistable_type' => 'App\Models\Pet']);

            $msg = 'success';
            $status = 200;
        }

        return response()->json(['msg' => $msg], $status);
    }

  // Wishlist ////////////////////////////////

    ####################################################################

  // Favorites ////////////////////////////////////
    public function favoriteProducts()
    {
        $products = Product::whereIn('id', Wishlist::where('user_id', auth('api')->id())
            ->where('wishlistable_type', 'App\Models\Product')
            ->pluck('wishlistable_id')
            ->toArray())
            ->get()
            ->makeHidden([
                'photo_1',
                'photo_2',
                'photo_3',
                'category_id',
                'admin_id',
                'color_id',
                'size_id',
                'style_id',
                'brand_id',
                'weight_id',
                'views',
                'status',
                'created_at',
                'updated_at',
                'deleted_at',
                'sku',
                'sku',
                'sku',
                'type',
                'description',
                'translations',
                ]);

        return response()->json(compact('products'));
    }

    public function favoritePets()
    {
        $pets = new PetCollection(Pet::whereIn('id', Wishlist::where('user_id', auth('api')->id())
        ->where('wishlistable_type', 'App\Models\Pet')
        ->pluck('wishlistable_id')
        ->toArray())->get());

        return response()->json(compact('pets'));
    }

    public function favoriteVets()
    {
        $vets = Vet::whereIn('id', Wishlist::where('user_id', auth('api')->id())
        ->where('wishlistable_type', 'App\Models\Vet')
        ->pluck('wishlistable_id')
        ->toArray())
        ->get()
        ->makeHidden([
                'phone',
                'password',
                'about_me',
                'category_id',
                'status',
                'created_at',
                'updated_at',
                'deleted_at',
                'wishlistable',
                ]);

        return response()->json(compact('vets'));
    }

  // End Favorites ////////////////////////////////

    ####################################################################

  // Pets ////////////////////////////////

    public function locationPetsLife()
    {
        $cities = City::with('areas')->get();

        return response()->json(compact('cities'));
    }

    public function petsLife($id)
    {
        // $pets = new PetCollection(Pet::where('area_id',$id)->get());
        $pets = new PetCollection(Pet::get());

        return response()->json(compact('pets'));
    }

    public function myPets()
    {
        $pets = new PetCollection(Pet::where('user_id', auth('api')->id())->get());

        return response()->json(compact('pets'));
    }

    public function createPet()
    {
        $genders = Gender::get()->makeHidden([
            'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);
        $breeds = Breed::get()->makeHidden([
              'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);
        $colors = Color::get()->makeHidden([
              'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);
        $types = PetType::get()->makeHidden([
              'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);

        return response()->json(compact('genders', 'breeds', 'colors', 'types'));
    }

    public function storePet(Request $request)
    {
        $validated = $request->validate(Pet::$rules);
        $validated['user_id'] = auth('api')->id();
        $validated['area_id'] = auth('api')->user()->area_id??1;

        $pet = Pet::create($validated);

        return response()->json(['msg' => 'success', 'pet' => $pet]);
    }

    public function pet(Pet $pet)
    {
        $pet =  new PetResources($pet);
        return response()->json(compact('pet'));
    }

    public function petInfo(Pet $pet)
    {
        $pet =  new PetResources($pet);

        return response()->json(compact('pet'));
    }

    public function petMedicalHistory(Pet $pet)
    {
        $title = 'Pet Medical History';
        $content =$pet->medical_history;

        return response()->json(compact('title', 'content'));
    }

    public function petVaccinations(Pet $pet)
    {
        $title = 'Vaccinations';
        $content =$pet->vaccinations;

        return response()->json(compact('title', 'content'));
    }

    public function editPet(Pet $pet)
    {
        $genders = Gender::get()->makeHidden([
              'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);
        $breeds = Breed::get()->makeHidden([
              'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);
        $colors = Color::get()->makeHidden([
              'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);
        $types = PetType::get()->makeHidden([
              'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);

        return response()->json(compact('pet', 'genders', 'breeds', 'colors', 'types'));
    }

    public function updatePet(Request $request, Pet $pet)
    {
        $validated = $request->validate(Pet::$rules);
        $pet->update($validated);

        return response()->json(['msg' => 'success']);
    }

    public function destroyPet(Pet $pet)
    {
        $pet->delete();

        return response()->json(['msg' => 'success']);
    }
  // Pets ////////////////////////////////

    ####################################################################

  // Pages ////////////////////////////////

    public function home()
    {
        $sliders = Slider::active()->inOrderToMobile()->get();
        $magazine = Magazine::get();

        return response()->json(compact('sliders', 'magazine'));
    }

    public function about()
    {
        $about = Page::findOrFail(1)->makeHidden([
            'id',
            'active',
            'in_navbar',
            'in_footer',
            'created_at',
            'updated_at',
            'deleted_at',
            'slug',
            'translations',
            ]);

        $logo = asset('uploads/images/original/'. Setting::where('key', 'logo')->first()->value);

        return response()->json(compact('about','logo'));
    }

    public function contact()
    {
        $contact = Page::findOrFail(3)->makeHidden([
            'id',
            'active',
            'in_navbar',
            'in_footer',
            'created_at',
            'updated_at',
            'deleted_at',
            'slug',
            'translations',
            ]);

        $informations = Information::get()->makeHidden([
            'id',
            'status',
            'deleted_at',
            'translations',
            ]);
        return response()->json(compact('contact', 'informations'));
    }

    public function sendContactMessage(Request $request)
    {
        $validated = $request->validate(Contact::$rules);
        Contact::create($validated);

        return response()->json(['msg' => 'success']);
    }

    public function termsAndConditions()
    {
        $termsAndConditions = Page::findOrFail(5)->makeHidden([
            'id',
            'active',
            'in_navbar',
            'in_footer',
            'created_at',
            'updated_at',
            'deleted_at',
            'slug',
            'translations',
            ]);

        return response()->json(compact('termsAndConditions'));
    }

    public function privacyPolicy()
    {
        $privacyPolicy = Page::findOrFail(6)->makeHidden([
            'id',
            'active',
            'in_navbar',
            'in_footer',
            'created_at',
            'updated_at',
            'deleted_at',
            'slug',
            'translations',
            ]);

        return response()->json(compact('privacyPolicy'));
    }

  // End Pages ////////////////////////////////

    ####################################################################

  // Vets ////////////////////////////////

    public function vets()
    {
        $vets = Vet::get();

        return response()->json(compact('vets'));
    }

    public function vetProfile($vetID)
    {
        $vet = Vet::findOrFail($vetID);

        $appointments = Appointment::where('vet_id', $vet->id)
        ->whereDate('date', '>=', now())
        ->with('periodsAvailable')
        ->first();

        return response()->json(compact('vet','appointments'));
    }

    public function vetInfo($vetID)
    {
        $vet = Vet::findOrFail($vetID)->makeHidden([
            'phone',
            "address",
            "area_id",
            "email",
            "status",
            "created_at",
            "updated_at",
            "deleted_at",
            "rate",
            "is_fav",
            "wishlistable",

            ]);

        return response()->json(compact('vet'));
    }

    public function vetMap($vetID)
    {
        $vet = Vet::with('area')->findOrFail($vetID)->makeHidden([
            'name',
            'phone',
            'address',
            'email',
            'password',
            'email_verified_at',
            'photo',
            'gender',
            'about_me',
            'status',
            'price',
            // 'latitude',
            // 'longitude',
            "created_at",
            "updated_at",
            "deleted_at",
            "rate",
            "is_fav",
            "average_vet_rate",
            "average_assistant_rate",
            "average_clinic_rate",
            "count_of_reviews",
            "reviews",
            "area_id",
            ]);
        return response()->json(compact('vet'));
    }

    public function vetReview($vetID)
    {

        $vet = Vet::find($vetID);
        $reviews = VetReview::where('vet_id', $vetID)
        ->with('user')
        ->get()
        ->makeHidden([
            'id',
            "user_id",
            "vet_id",
            // "doctor_rate",
            "assistant_rate",
            "clinic_rate",
            // "comment",
            // "created_at",
            "updated_at",
            "deleted_at",
            ]);

        $count_of_reviews = $vet->reviews->count();
        $average_vet_rate = $vet->vetReview()->avg('doctor_rate');
        $average_assistant_rate =  $vet->vetReview()->avg('assistant_rate');
        $average_clinic_rate = $vet->vetReview()->avg('clinic_rate');

        return response()->json(compact('count_of_reviews', 'average_vet_rate', 'average_assistant_rate', 'average_clinic_rate', 'reviews'));
    }

    public function vetAppointmentPeriod($appointmentID)
    {
        $periodsAvailable = AppointmentPeriod::where('appointment_id', $appointmentID)
        ->whereNull('user_id')
        ->get();

        return response()->json(compact('periodsAvailable'));
    }

    public function vetAppointmentCalendar($vetID)
    {
        $appointments = Appointment::where('vet_id', $vetID)
        ->whereDate('date', '>=', now())
        ->with('periodsAvailable')
        ->orderBy('date')
        ->get();

        return response()->json(compact('appointments'));
    }

    public function checkoutAppointment($appointmentPeriodID)
    {

        $period = AppointmentPeriod::with('appointment')->find($appointmentPeriodID);
        $vet = Vet::findOrFail($period->appointment->vet_id);

        return response()->json(compact('vet', 'period'));
    }

    public function appointmentBooking($appointmentPeriodID)
    {

        $period = AppointmentPeriod::find($appointmentPeriodID);

        $period->update(['user_id'=>auth('api')->id()]);

        $text= __('lang.msg_appointment_booked'). $period->appointment->month_name . ' '. $period->appointment->date .' '.  $period->start_at .' to '. $period->end_at;
        return response()->json([ 'msg' => 'success', 'text'=> $text, 'period' => $period ]);
    }

    public function storeVetReview(Request $request, $vetID)
    {

        $validated = $request->validate([
            'doctor_rate' => 'required|starts_with:1,2,3,4,5',
            'assistant_rate' => 'required||starts_with:1,2,3,4,5',
            'clinic_rate' => 'required||starts_with:1,2,3,4,5',
            'comment' => 'required',
        ]);

        $vet = Vet::findOrFail($vetID);
        $validated['vet_id'] = $vet->id;
        $validated['user_id'] = auth('api')->id();

        VetReview::updateOrCreate(['vet_id'=>$vet->id, 'user_id'=>auth('api')->id()], $validated);

        return response()->json(['msg' => 'Make a Review']);
    }

  // End Vets ////////////////////////////////

    ####################################################################

  // Reviews ////////////////////////////////

    public function reviews()
    {
        return response()->json(['msg' => 'All Reviews']);
    }

    public function sendReview(Request $request, ProductReview $productReview)
    {

        // $validated = $request->validate(ProductReview::$rules);
        // $validated['user_id'] = auth('api')->id();
        // $productReview->create($validated);
        // dd($productReview);

        return response()->json(['msg' => 'Make a Review']);
    }

  // End Reviews ////////////////////////////////

    ####################################################################

  // Magazine ////////////////////////////////

    public function allCategoryMagazine(Request $request)
    {
        $categories = Category::parent()
            ->with('children')
            ->inOrderTOMagazine()
            ->get()
            ->makeHidden([
            'photo',
            'status',
            'in_order_to',
            'parent_id',
            'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);

        return response()->json(compact('categories'));
    }

    public function magazine(Request $request)
    {
        $categories = Category::parent()
            ->with('children')
            ->inOrderTOMagazine()
            ->get()
            ->makeHidden([
            'photo',
            'status',
            'in_order_to',
            'parent_id',
            'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);

        $query =  Magazine::query();

        if (request()->filled('category')) {
            $query->where('category_id', request('category'));
        }

        $magazine =  $query->get()->makeHidden([
            'category_id',
            'photo',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);

        return response()->json(compact('categories', 'magazine'));
    }

    public function magazineCategory(Category $category)
    {
        $category =$category->makeHidden([
            'photo',
            'status',
            'in_order_to',
            'parent_id',
            'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            'photo_original_path',
            'photo_thumbnail_path',

            ]);
        $magazine =  Magazine::where('category_id', $category->id)->get()->makeHidden([
            'category_id',
            'photo',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);

        return response()->json(compact('category', 'magazine'));
    }

    public function article(Magazine $magazine)
    {
        $article = $magazine->makeHidden([
            'category_id',
            'photo',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
            'translations',
            ]);

        return response()->json(compact('article'));
    }


  // Magazine ////////////////////////////////

    ####################################################################

  // Filters ////////////////////////////////

    public function filter()
    {
        $colors = Color::get()->makeHidden([
            'created_at',
          'updated_at',
          'deleted_at',
          'translations',
          ]);
      $sizes = Size::get()->makeHidden([
            'created_at',
          'updated_at',
          'deleted_at',
          'translations',
          ]);
      $styles = Style::get()->makeHidden([
            'created_at',
          'updated_at',
          'deleted_at',
          'translations',
          ]);
      $brands = Brand::get()->makeHidden([
            'created_at',
          'updated_at',
          'deleted_at',
          'translations',
          ]);

        return response()->json(compact('colors', 'sizes', 'styles', 'brands'));
    }

    public function filterProducts(Request $request)
    {
        $query = Product::query();


        if(request()->filled('color_id')){
            $query->where('color_id', request('color_id'));
        }
        if(request()->filled('size_id')){
            $query->where('size_id', request('size_id'));
        }

        if(request()->filled('style_id')){
            $query->where('style_id', request('style_id'));
        }



        if(request()->filled('offer')){
            if(request('offer') == 0){$query->where('sale_price','>','0');}
            if(request('offer') == 1){$query->where('sale_price','<','0');}
        }

        if(request()->filled('price_from') || request()->filled('price_to')){
            $from = request()->filled('price_from')? request('price_from'):1;
            $to = request()->filled('price_to')? request('price_to'):10000000;
            $query->whereBetween('regular_price', [$from , $to]);
        }

        $products = $query->get()->makeHidden([
            'photo_1',
            'photo_2',
            'photo_3',
            'category_id',
            'admin_id',
            'color_id',
            'size_id',
            'style_id',
            'brand_id',
            'weight_id',
            'views',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
            'sku',
            'type',
            'description',
            'translations',
            ]);

        $filtreBy = $request->all();

        if(request()->filled('rate')){

            $from = request('rate');
            $to = request('rate');

            $products = $products->whereBetween('rate', [--$from, $to]);

            return response()->json(compact('filtreBy', 'products'));
        }
        return response()->json(compact('filtreBy', 'products'));
    }

  // Filters ////////////////////////////////

    ####################################################################

  // User Dashboard ////////////////////////////////

    public function dashboard()
    {
        $user = User::find(auth('api')->id());
        return response()->json($user);
    }

    public function profile()
    {
        $user = User::find(auth('api')->id());
        return response()->json($user);
    }
    public function profileOwnerPet($id)
    {
        $user = User::find($id)->makeHidden([
            'area_id',
            'phone',
            'email',
            'address',
            'start_as',
            'email_verified_at',
            'verify_code',
            'photo',
            'about_me',
            'status',
            'deleted_at',
            'created_at',
            'updated_at',
            'gender',
            'area',
            'city',
        ]);
        $location = $user->address.', '.$user->area->text .', '. $user->area->city->text;
        return response()->json(compact('user', 'location'));
    }

    public function updatePhoto(Request $request)
    {
        $photo = $request->validate(['photo' => 'required|image|mimes:jpeg,jpg,png']);

        $user = auth('api')->user();

        $user->update($photo);

        return response()->json(['msg' => 'Photo Updated']);
    }

    public function updatePassword(Request $request)
    {
        $user = auth('api')->user();
        $password = $request->validate(['password' => 'required|string|min:6|confirmed']);
        if (Hash::check(request('old_password'), $user->password)) {

            $user->update($password);

            return response()->json(['msg' => __('messages.updated', ['model' => __('models/users.fields.password')])]);
        }

        return response()->json(['msg' => __('messages.incorrect', ['model' => __('models/users.fields.old_password')])], 403);
    }

    public function personalInformation()
    {
        $user = auth('api')->user()->makeHidden([
            'id',
            'photo',
            'status',
            'start_as',
            'email_verified_at',
            'verify_code',
            'about_me',
            'gender',
            'created_at',
            'updated_at',
            'deleted_at',
            ]);

        $areas = Area::get()->makeHidden([
            'status',
            'city_id',
            'deleted_at',
            'translations',
            ]);

        return response()->json(compact('user', 'areas'));
    }

    public function updatePersonalInformation(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|min:3|max:191",
            'phone' => 'required|numeric',
            'email' => 'required|email',
            "address" => "required|string|min:3|max:191",
            "area_id" => "required",
       ]);

        $user = auth('api')->user();

        if($user->email != $request->email){
            $data['email_verified_at'] = null;
            event(new Registered($user));
        }

        $user->update($data);

        return response()->json(['msg' => __('messages.updated', ['model' => __('models/users.fields.basic_information')])]);
    }

    public function myAppointments()
    {
        $periods = AppointmentPeriod::where('user_id', auth('api')->id())->with('appointment', 'vet')->get();

        return response()->json(compact('periods'));
    }

    public function myAppointment($id)
    {
        $period = AppointmentPeriod::with('appointment', 'vet')->find($id);

        return response()->json(compact('period'));
    }

  // End User Dashboard ////////////////////////////////

    ####################################################################

  // Chat ////////////////////////////////

    public function chatRooms()
    {
        $rooms = Chat::with('vet')
        ->where('user_id', auth('api')->id())
        ->chat()
        ->get();

        return response()->json(compact('rooms'));
    }

    public function updateSeen($roomID)
    {
        $contents = ChatContent::where('chat_id', $roomID)
        ->where('senderable_type', 'App\Models\Vet')
        ->get();

        foreach($contents as $content){ $content->update(['seen'=>1]);}
    }

    public function chat($id)
    {
        $room = Chat::with('vet')->find($id);
        $room->update(['count_new_message'=>0]);
        $contents = ChatContent::where('chat_id', $room->id)->latest()->get();
        $type_chat = 1;
        $channel = 'chat-'.$room->id;
        $room_channel = 'private-chat-'.$room->id;

        return response()->json(compact('room', 'contents','type_chat', 'channel', 'room_channel'));
    }

    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'type_chat'=>'required',
            'content'=>'',
            'file'=>'',
        ]);

        $userId = auth('api')->id();

        $room = Chat::updateOrCreate([
            'vet_id'=>$id,
            'user_id'=>$userId,
            'type'=>request('type_chat'),//1=>chat, 2=>customer service
        ]);

        $dataRequest=[
            'chat_id'   =>$room->id,
            'seen'      =>0,//0=>no, 1=>yes
            'senderable_id'   =>$userId,
            'senderable_type'   =>'App\Models\User',
            'content'   =>request('content'),
        ];

        if(request()->has('file')){

            $file = $request->file('file');
            $type = explode('/',$file->getClientMimeType());


            switch ($type[0]) {
                case 'image': $dataRequest['photo']=request('file'); break;
                case 'audio': $dataRequest['audio']=request('file'); break;
                case 'video': $dataRequest['video']=request('file'); break;
                default: $dataRequest['file']=request('file'); break;
            }

        }

        $content = ChatContent::create($dataRequest);

        event(new EventsChat(['data_to'=>'chat', 'data'=>$content, 'send_to'=> 'private-chat-'.$room->id, 'channel'=>'chat-'.$room->id]));
        event(new EventsChat(['data_to'=>'chat', 'data'=>$content, 'send_to'=> $room->vet->email .'-'. $room->vet_id, 'channel'=>$room->vet->email .'-'. $room->vet_id]));

        $room->increment('count_new_message_vet');
        $room->update(['count_new_message'=>0]);

        return response()->json(['msg'=>'success','content'=>$content]);


    }

  // End Chat ////////////////////////////////
}
