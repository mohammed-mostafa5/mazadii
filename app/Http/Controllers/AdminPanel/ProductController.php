<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\ProductRepository;
use App\Http\Requests\AdminPanel\CreateProductRequest;
use App\Http\Requests\AdminPanel\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Style;
use App\Models\Weight;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    public function index(Request $request)
    {
        $products = Product::get();

        return view('adminPanel.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::active()
            ->parent()
            ->inOrderTOProdcut()
            ->with('children')
            ->get();

        $colors = Color::get()->pluck('text', 'id');
        $sizes = Size::get()->pluck('text', 'id');
        $styles = Style::get()->pluck('text', 'id');
        $brands = Brand::get()->pluck('text', 'id');
        $weights = Weight::get()->pluck('text', 'id');

        return view('adminPanel.products.create', compact('categories', 'colors', 'sizes', 'styles', 'brands', 'weights'));
    }

    public function store(CreateProductRequest $request)
    {
        $input = $request->all();
        $input['admin_id'] = auth()->id();

        $this->productRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/products.singular')]));

        return redirect(route('adminPanel.products.index'));
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('adminPanel.products.index'));
        }

        return view('adminPanel.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = $this->productRepository->find($id);

        $categories = Category::active()
            ->parent()
            ->inOrderTOProdcut()
            ->with('children')
            ->get();

        $colors = Color::get()->pluck('text', 'id');
        $sizes = Size::get()->pluck('text', 'id');
        $styles = Style::get()->pluck('text', 'id');
        $brands = Brand::get()->pluck('text', 'id');
        $weights = Weight::get()->pluck('text', 'id');

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('adminPanel.products.index'));
        }

        return view('adminPanel.products.edit', compact('categories', 'product', 'colors', 'sizes', 'styles', 'brands', 'weights'));
    }

    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('adminPanel.products.index'));
        }

        $this->productRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/products.singular')]));

        return redirect(route('adminPanel.products.index'));
    }

    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error(__('messages.not_found', ['model' => __('models/products.singular')]));

            return redirect(route('adminPanel.products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/products.singular')]));

        return redirect(route('adminPanel.products.index'));
    }
}
