<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;

class SearchController extends AppBaseController
{

    public function search(Request $request)
    {
        $queryProducts = Product::query()->active();

        if (request('type') == 'companies') {

            // Companies
            if (request()->filled('search')) {
                $companies = Company::where('name', 'like', '%' . request('search') . '%')
                    ->pluck('id')
                    ->toArray();

                // $companies = $query->pluck('id')->toArray();
                $queryProducts->whereIn('company_id', $companies);
            }
        } else {

            // Producs
            if (request()->filled('search')) {
                $queryProducts->whereTranslationLike('name', '%' . request('search') . '%');
            }
        }

        if (request()->filled('sort')) {

            $sort = explode('-', request('sort'));


            try {

                $queryProducts->OrderBy($sort[0], $sort[1]);
            } catch (\Throwable $th) {

                return back();
            }
        }

        $products = $queryProducts->paginate(20);
        return view('website.search', compact('products'));
    }
}
