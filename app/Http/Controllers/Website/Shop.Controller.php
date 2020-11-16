<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Product;
use App\Models\Category;


class ShopController extends AppBaseController
{
   protected $path_pages = 'website.shop.page.';
   protected $path_includes = 'website.shop.includes.';

   public function category($id)
   {
      $query = Product::query()->active();

      if (request()->filled('sort')) {

         $sort = explode('-', request('sort'));


         try {

            $query->OrderBy($sort[0], $sort[1]);
         } catch (\Throwable $th) {

            return back();
         }
      }
      $cate = Category::findOrFail($id);

      if ($cate->parent_id == null) {
         $products = $query->whereIn('category_id', $cate->children->pluck('id')->toArray())->inOrderTOProdcut()->paginate(20);
      } else {
         $products = $query->where('category_id', $id)->inOrderTOProdcut()->paginate(20);
      }

      $categories = Category::parent()
         ->active()
         ->with('children')
         ->get();

      $ads = Ads::where('page', $cate->translate('en')->name)->get();
      $path_includes =$this->path_includes;
      return view($this->path_pages.'category', compact('products', 'categories', 'id', 'ads', 'path_includes'));
   }

   public function products()
   {
      $query = Product::query()->active();

      if (request()->filled('sort')) {

         $sort = explode('-', request('sort'));


         try {

            $query->OrderBy($sort[0], $sort[1]);
         } catch (\Throwable $th) {

            return back();
         }
      }

      $products = $query->paginate(20);

      $categories = Category::parent()
         ->active()
         ->inOrderTOProdcut()
         ->with('children')
         ->get();
      $path_includes = $this->path_includes;
      return view($this->path_pages.'products', compact('products', 'categories','path_includes'));
   }

   public function offers()
   {
      $query = Product::query()->active();

      if (request()->filled('sort')){

        $sort = explode('-', request('sort'));
        try {

            $query->offers()->OrderBy($sort[0], $sort[1]);
        } catch (\Throwable $th) {

            return back();
        }

      }

        $products = $query->offers()->paginate(20);

        $categories = Category::parent()
        ->active()
        ->inOrderTOProdcut()
        ->with('children')
        ->get();

        $path_includes = $this->path_includes;
        return view($this->path_pages.'products', compact('products', 'categories','path_includes'));
   }

   public function product($id)
   {
      $product = Product::findOrFail($id);
      $product->increment('views', 1);
      return view($this->path_pages.'.product', compact('product'));
   }

   public function reviewProduct($id, Request $request)
   {
        if ($request->rate > 0) {

            $product = Product::findOrFail($id);

            $product->reviews()->syncWithoutDetaching([auth()->id() => ['rate' => request('rate'), 'comment' => request('comment')]]);

            return back()->with(['alertStatus' => 'Thanks for your review', 'icon' => 'success']);
        }

        return back()->with(['alertStatus' => 'Sorry, the number of stars must be determined first', 'icon' => 'error']);
   }

}
