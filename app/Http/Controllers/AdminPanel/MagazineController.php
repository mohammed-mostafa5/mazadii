<?php

namespace App\Http\Controllers\AdminPanel;

use Flash;
use Response;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AdminPanel\MagazineRepository;
use App\Http\Requests\AdminPanel\CreateMagazineRequest;
use App\Http\Requests\AdminPanel\UpdateMagazineRequest;

class MagazineController extends AppBaseController
{
    /** @var  MagazineRepository */
    private $magazineRepository;

    public function __construct(MagazineRepository $magazineRepo)
    {
        $this->magazineRepository = $magazineRepo;
    }

    /**
     * Display a listing of the Magazine.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $magazines = $this->magazineRepository->all();

        return view('adminPanel.magazines.index')
            ->with('magazines', $magazines);
    }

    /**
     * Show the form for creating a new Magazine.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::active()
        ->parent()
        ->inOrderTOMagazine()
        ->with('children')
        ->get();

        return view('adminPanel.magazines.create', compact('categories'));
    }

    /**
     * Store a newly created Magazine in storage.
     *
     * @param CreateMagazineRequest $request
     *
     * @return Response
     */
    public function store(CreateMagazineRequest $request)
    {
        $input = $request->all();

        $magazine = $this->magazineRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/magazines.singular')]));

        return redirect(route('adminPanel.magazines.index'));
    }

    /**
     * Display the specified Magazine.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $magazine = $this->magazineRepository->find($id);

        if (empty($magazine)) {
            Flash::error(__('messages.not_found', ['model' => __('models/magazines.singular')]));

            return redirect(route('adminPanel.magazines.index'));
        }

        return view('adminPanel.magazines.show')->with('magazine', $magazine);
    }

    /**
     * Show the form for editing the specified Magazine.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $magazine = $this->magazineRepository->find($id);

        if (empty($magazine)) {
            Flash::error(__('messages.not_found', ['model' => __('models/magazines.singular')]));

            return redirect(route('adminPanel.magazines.index'));
        }

        $categories = Category::active()
        ->parent()
        ->inOrderTOMagazine()
        ->with('children')
        ->get();

        return view('adminPanel.magazines.edit', compact('magazine','categories'));
    }

    /**
     * Update the specified Magazine in storage.
     *
     * @param int $id
     * @param UpdateMagazineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMagazineRequest $request)
    {
        $magazine = $this->magazineRepository->find($id);

        if (empty($magazine)) {
            Flash::error(__('messages.not_found', ['model' => __('models/magazines.singular')]));

            return redirect(route('adminPanel.magazines.index'));
        }

        $magazine = $this->magazineRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/magazines.singular')]));

        return redirect(route('adminPanel.magazines.index'));
    }

    /**
     * Remove the specified Magazine from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $magazine = $this->magazineRepository->find($id);

        if (empty($magazine)) {
            Flash::error(__('messages.not_found', ['model' => __('models/magazines.singular')]));

            return redirect(route('adminPanel.magazines.index'));
        }

        $this->magazineRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/magazines.singular')]));

        return redirect(route('adminPanel.magazines.index'));
    }
}
