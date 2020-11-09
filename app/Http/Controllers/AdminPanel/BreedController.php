<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateBreedRequest;
use App\Http\Requests\AdminPanel\UpdateBreedRequest;
use App\Repositories\AdminPanel\BreedRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BreedController extends AppBaseController
{
    /** @var  BreedRepository */
    private $breedRepository;

    public function __construct(BreedRepository $breedRepo)
    {
        $this->breedRepository = $breedRepo;
    }

    /**
     * Display a listing of the Breed.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $breeds = $this->breedRepository->all();

        return view('adminPanel.breeds.index')
            ->with('breeds', $breeds);
    }

    /**
     * Show the form for creating a new Breed.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.breeds.create');
    }

    /**
     * Store a newly created Breed in storage.
     *
     * @param CreateBreedRequest $request
     *
     * @return Response
     */
    public function store(CreateBreedRequest $request)
    {
        $input = $request->all();

        $breed = $this->breedRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/breeds.singular')]));

        return redirect(route('adminPanel.breeds.index'));
    }

    /**
     * Display the specified Breed.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $breed = $this->breedRepository->find($id);

        if (empty($breed)) {
            Flash::error(__('messages.not_found', ['model' => __('models/breeds.singular')]));

            return redirect(route('adminPanel.breeds.index'));
        }

        return view('adminPanel.breeds.show')->with('breed', $breed);
    }

    /**
     * Show the form for editing the specified Breed.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $breed = $this->breedRepository->find($id);

        if (empty($breed)) {
            Flash::error(__('messages.not_found', ['model' => __('models/breeds.singular')]));

            return redirect(route('adminPanel.breeds.index'));
        }

        return view('adminPanel.breeds.edit')->with('breed', $breed);
    }

    /**
     * Update the specified Breed in storage.
     *
     * @param int $id
     * @param UpdateBreedRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBreedRequest $request)
    {
        $breed = $this->breedRepository->find($id);

        if (empty($breed)) {
            Flash::error(__('messages.not_found', ['model' => __('models/breeds.singular')]));

            return redirect(route('adminPanel.breeds.index'));
        }

        $breed = $this->breedRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/breeds.singular')]));

        return redirect(route('adminPanel.breeds.index'));
    }

    /**
     * Remove the specified Breed from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $breed = $this->breedRepository->find($id);

        if (empty($breed)) {
            Flash::error(__('messages.not_found', ['model' => __('models/breeds.singular')]));

            return redirect(route('adminPanel.breeds.index'));
        }

        $this->breedRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/breeds.singular')]));

        return redirect(route('adminPanel.breeds.index'));
    }
}
