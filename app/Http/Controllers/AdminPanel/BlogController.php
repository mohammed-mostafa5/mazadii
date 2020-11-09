<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\BlogRepository;
use App\Http\Requests\AdminPanel\CreateBlogRequest;
use App\Http\Requests\AdminPanel\UpdateBlogRequest;

class BlogController extends AppBaseController
{
    /** @var  BlogRepository */
    private $blogRepository;

    public function __construct(BlogRepository $blogRepo)
    {
        $this->blogRepository = $blogRepo;
    }

    /**
     * Display a listing of the Blog.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $blogs = $this->blogRepository->paginate(10);

        return view('adminPanel.blogs.index')
            ->with('blogs', $blogs);
    }

    /**
     * Show the form for creating a new Blog.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::active()
        ->parent()
        ->inOrderTOBlog()
        ->with('children')
        ->get();

        return view('adminPanel.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created Blog in storage.
     *
     * @param CreateBlogRequest $request
     *
     * @return Response
     */
    public function store(CreateBlogRequest $request)
    {
        $input = $request->all();

        $blog = $this->blogRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/blogs.singular')]));

        return redirect(route('adminPanel.blogs.index'));
    }

    /**
     * Display the specified Blog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $blog = $this->blogRepository->find($id);

        if (empty($blog)) {
            Flash::error(__('messages.not_found', ['model' => __('models/blogs.singular')]));

            return redirect(route('adminPanel.blogs.index'));
        }

        return view('adminPanel.blogs.show')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified Blog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $blog = $this->blogRepository->find($id);

        if (empty($blog)) {
            Flash::error(__('messages.not_found', ['model' => __('models/blogs.singular')]));

            return redirect(route('adminPanel.blogs.index'));
        }

        $categories = Category::active()
        ->parent()
        ->inOrderTOBlog()
        ->with('children')
        ->get();

        return view('adminPanel.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified Blog in storage.
     *
     * @param int $id
     * @param UpdateBlogRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBlogRequest $request)
    {
        $blog = $this->blogRepository->find($id);

        if (empty($blog)) {
            Flash::error(__('messages.not_found', ['model' => __('models/blogs.singular')]));

            return redirect(route('adminPanel.blogs.index'));
        }

        $blog = $this->blogRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/blogs.singular')]));

        return redirect(route('adminPanel.blogs.index'));
    }

    /**
     * Remove the specified Blog from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $blog = $this->blogRepository->find($id);

        if (empty($blog)) {
            Flash::error(__('messages.not_found', ['model' => __('models/blogs.singular')]));

            return redirect(route('adminPanel.blogs.index'));
        }

        $this->blogRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/blogs.singular')]));

        return redirect(route('adminPanel.blogs.index'));
    }
}
