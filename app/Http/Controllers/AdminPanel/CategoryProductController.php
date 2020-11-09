<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\CategoryRepository;
use App\Http\Requests\AdminPanel\CreateCategoryRequest;
use App\Http\Requests\AdminPanel\UpdateCategoryRequest;

class CategoryProductController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $CategoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->CategoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = $this->CategoryRepository
        ->allQueryTranslations($request->all())
        ->parent()
        ->with('children')
        ->inOrderTOProdcut()
        ->get();

        return view('adminPanel.categoryProduct.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->CategoryRepository
        ->allQuery()
        ->parent()
        ->inOrderTOProdcut()
        ->active()
        ->get();

        return view('adminPanel.categoryProduct.create', compact('categories'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CreatecategoryRequest $request
     *
     * @return Response
     */
    public function store(CreatecategoryRequest $request)
    {

        $input = $request->all();
        $input['in_order_to'] = 1;

        $category = $this->CategoryRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/categoryProduct.singular')]));

        return redirect(route('adminPanel.categoryProduct.index'));
    }

    /**
     * Display the specified category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->CategoryRepository->find($id);

        if (empty($category)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categoryProduct.singular')]));

            return redirect(route('adminPanel.categoryProduct.index'));
        }

        return view('adminPanel.categoryProduct.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->CategoryRepository->find($id);

        if (empty($category)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categoryProduct.singular')]));

            return redirect(route('adminPanel.categoryProduct.index'));
        }

        $categories = $this->CategoryRepository
        ->allQuery()
        ->parent()
        ->inOrderTOProdcut()
        ->active()
        ->get();

        return view('adminPanel.categoryProduct.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param int $id
     * @param UpdatecategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecategoryRequest $request)
    {
        $category = $this->CategoryRepository->find($id);

        if (empty($category)) {
            Flash::error(__('messages.not_found', ['model' => __('models/categoryProduct.singular')]));

            return redirect(route('adminPanel.categoryProduct.index'));
        }

        $category = $this->CategoryRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/categoryProduct.singular')]));

        return redirect(route('adminPanel.categoryProduct.index'));
    }

    /**
     * Remove the specified category from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->CategoryRepository->find($id);

        if (empty($category) || $category->products->count() > 0) {
            Flash::error(__('messages.not_found', ['model' => __('models/categoryProduct.singular')]));

            return redirect(route('adminPanel.categoryProduct.index'));
        }

        $this->CategoryRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/categoryProduct.singular')]));

        return redirect(route('adminPanel.categoryProduct.index'));
    }
}
