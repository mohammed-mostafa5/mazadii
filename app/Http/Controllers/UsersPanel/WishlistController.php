<?php

namespace App\Http\Controllers\UsersPanel;

use Flash;
use Response;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

class WishlistController extends AppBaseController
{
    public function wishlist()
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('wishlistable_type', 'App\Models\Product')
            ->get();

        return view('usersPanel.page.wishlist', compact('wishlist'));
    }

    public function removeProductWishlist($id)
    {

        $item = Wishlist::where('user_id', auth()->id())->where('id', $id)->first();
        if ($item) {

            $item->delete();

            return  back()->with(['alertStatus' => 'Your wishlist is empty', 'icon' => 'success']);
        }

        return  back()->with(['alertStatus' => 'Your wishlist is empty', 'icon' => 'warning']);
    }

    public function addToWishlistOrRemoveProduct($id)
    {

        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('wishlistable_id', $id)
            ->where('wishlistable_type', 'App\Models\Product')
            ->first();

        if ($wishlist) {

            $wishlist->delete();

            return  response()->json(['msg' => 'Deleted From Wishlist', 'iconAlert' => 'success', 'icon' => '<i class="fa fa-heart-o"></i>', 'for' => '.count-wishlist', 'count' => count(auth()->user()->whishlistProduct())]);
        } else {

            $item = Wishlist::create(['user_id' => auth()->id(), 'wishlistable_id' => $id, 'wishlistable_type' => 'App\Models\Product']);

            return  response()->json(['msg' => 'Added to Wishlist', 'iconAlert' => 'success', 'icon' => '<i class="fa fa-heart text-danger"></i>', 'for' => '.count-wishlist', 'count' => count(auth()->user()->whishlistProduct())]);
        }
    }

    public function addToWishlistOrRemoveVet($id)
    {

        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('wishlistable_id', $id)
            ->where('wishlistable_type', 'App\Models\Product')
            ->first();

        if ($wishlist) {

            $wishlist->delete();

            return  response()->json(['msg' => 'Deleted From Wishlist', 'icon' => '<i class="fa fa-heart-o"></i>']);
        } else {

            Wishlist::create(['user_id' => auth()->id(), 'wishlistable_id' => $id, 'wishlistable_type' => 'App\Models\Product']);

            return  response()->json(['msg' => 'Added to Wishlist', 'icon' => '<i class="fa fa-heart text-danger"></i>']);
        }
    }

    public function addToWishlistOrRemovePet($id)
    {

        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('wishlistable_id', $id)
            ->where('wishlistable_type', 'App\Models\Pet')
            ->first();

        if ($wishlist) {

            $wishlist->delete();

            return  response()->json(['msg' => 'Deleted From Wishlist', 'icon' => '<i class="fa fa-heart-o"></i>']);
        } else {

            Wishlist::create(['user_id' => auth()->id(), 'wishlistable_id' => $id, 'wishlistable_type' => 'App\Models\Pet']);

            return  response()->json(['msg' => 'Added to Wishlist', 'icon' => '<i class="fa fa-heart text-danger"></i>']);
        }
    }
}
