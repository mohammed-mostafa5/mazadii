<?php

namespace App\Http\Controllers\Website;

use Flash;
use App\Models\Ads;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Distributor;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;
use App\Http\Controllers\AppBaseController;
use App\Mail\ContactUs;
use App\Models\Blog;
use App\Models\images;
use App\Models\Paragraph;

class MainController extends AppBaseController
{



    public function coming_soon()
    {
        return view('website.coming_soon');
    }

    public function home()
    {
        // 128M php.ini
        // $categories = [];
        // $products = Product::latest()->limit(4)->get();
        // $bestSeller = Product::orderBy('views', 'desc')->limit(4)->get();
        // $partners = Partner::get();
        // $slider = Slider::where('status', 'Active')->inOrderToWeb()->get();
        // $page = Page::whereTranslation('name', 'home')->first();
        // $offers = [];
        // $ads = Ads::where('page', 'home')->get();


        // $paragraphes = Paragraph::where('page_id', 2)->get();
        // $images = images::where('page_id', 2)->get();
        // $blogs = Blog::get();

        return view('website.home',
            //  compact('categories', 'products', 'bestSeller', 'partners', 'ads', 'slider', 'offers', 'page', 'paragraphes', 'images', 'blogs')
        );
    }

    public function about()
    {
        $page = Page::whereTranslation('name', 'Who We Are')->first();

        return view('website.about', compact('page'));
    }

    public function contact()
    {
        $page = Page::whereTranslation('name', 'contact')->first();
        $informations = Information::active()->get();
        return view('website.contact', compact('informations', 'page'));
    }

    public function contactPost(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response'   => 'required',
        ]);

        Contact::create($data);

        Mail::to('admin@ellistaa.com')->send(new ContactUs($data));

        return back()->with(['alertStatus' => 'Message Sent Successfully', 'icon' => 'success']);
    }

    public function newslettrePost(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
        ]);

        Newsletter::create($data);
        Mail::to('admin@ellistaa.com')->send(new NewsletterMail($data));
        return back()->with(['alertStatus' => 'You are subscribed successfully', 'icon' => 'success']);
    }

    public function blogs(Request $request)
    {
        // $query = Blog::query();

        // if (request()->filled('articles-search')) {
        //    $query->whereTranslationLike('title', '%' . request('articles-search') . '%')
        //       ->orWhereTranslationLike('content', '%' . request('articles-search') . '%');
        // }

        // $blogs = $query->active()->paginate(9);

        $blogs = [];

        return view('website.blogs', compact('blogs'));
    }

    public function blog($id)
    {
        // $blog = Blog::findOrFail($id);
        // $topBlogs = Article::active()->latest()->where('id', '!=', $id)->take(6)->get();


        // return view('website.article', compact('article', 'topArticles'));
        return view('website.blog');
    }

    public function syndicateNews(Request $request)
    {
        $query = Article::query();

        if (request()->filled('syndicate-search')) {
            $query->whereTranslationLike('title', '%' . request('syndicate-search') . '%')
                ->orWhereTranslationLike('body', '%' . request('syndicate-search') . '%');
        }

        $articles = $query->active()->syndicate()->paginate(9);

        return view('website.articles', compact('articles'));
    }

    public function syndicateNewsOne($id)
    {
        $article = Article::findOrFail($id);
        $topArticles = Article::active()->latest()->where('id', '!=', $id)->syndicate()->take(6)->get();


        return view('website.article', compact('article', 'topArticles'));
    }

    public function how()
    {
        $page = Page::whereTranslation('name', 'How it works')->first();
        return view('website.how-it-works', compact('page'));
    }

    public function termsAndConditions()
    {
        $page = Page::whereTranslation('name', 'Terms and conditions')->first();
        return view('website.terms-and-conditions', compact('page'));
    }

    public function privacyPolicy()
    {
        $page = Page::whereTranslation('name', 'Privacy Policy')->first();
        return view('website.privacy-policy', compact('page'));
    }

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
            $products = $query->whereIn('category_id', $cate->children->pluck('id')->toArray())->paginate(20);
        } else {
            $products = $query->where('category_id', $id)->paginate(20);
        }

        $categories = Category::parent()
            ->active()
            ->with('children')
            ->get();

        $ads = Ads::where('page', $cate->translate('en')->name)->get();

        return view('website.category', compact('products', 'categories', 'id', 'ads'));
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
            ->with('children')
            ->get();
        return view('website.shop.page.products', compact('products', 'categories'));
    }


    public function productsOffers()
    {
        $query = Product::query()->active();

        if (request()->filled('sort')) {

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
            ->with('children')
            ->get();
        return view('website.products', compact('products', 'categories'));
    }

    public function product($id)
    {
        $product = Product::findOrFail($id);

        return view('website.shop.product', compact('product'));
    }



    /**
     * distributor Profile Page
     */
    public function distributorProfile($id)
    {
        $company = Distributor::findOrFail($id);

        return view('website.company-profile', compact('company'));
    }

    public function shopVendor($id)
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
        // $products->pluck('category_id')->toArray();
        $products = $query->where('company_id', $id)->paginate(20);
        $categories = Category::parent()
            ->active()
            ->with('children')
            ->get();

        return view('website.products', compact('products', 'categories'));
    }



    public function reviewProduct($id, Request $request)
    {

        if ($request->rate > 0) {

            $product = Product::findOrFail($id);

            $product->reviews()->syncWithoutDetaching([auth()->id() => ['rate' => request('rate')]]);

            return back()->with(['alertStatus' => 'Thanks for your review', 'icon' => 'success']);
        }
        return back()->with(['alertStatus' => 'Sorry, the number of stars must be determined first', 'icon' => 'error']);
    }
}
