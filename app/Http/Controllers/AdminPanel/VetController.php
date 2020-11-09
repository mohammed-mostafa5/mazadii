<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateVetRequest;
use App\Http\Requests\AdminPanel\UpdateVetRequest;
use App\Repositories\AdminPanel\VetRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Area;
use Illuminate\Http\Request;
use Flash;
use Response;

class VetController extends AppBaseController
{
    /** @var  VetRepository */
    private $vetRepository;

    public function __construct(VetRepository $vetRepo)
    {
        $this->vetRepository = $vetRepo;
    }

    /**
     * Display a listing of the Vet.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $vets = $this->vetRepository->all();

        return view('adminPanel.vets.index')
            ->with('vets', $vets);
    }

    /**
     * Show the form for creating a new Vet.
     *
     * @return Response
     */
    public function create()
    {
        $areas = Area::get()->pluck('text', 'id');
        return view('adminPanel.vets.create', compact('areas'));
    }

    /**
     * Store a newly created Vet in storage.
     *
     * @param CreateVetRequest $request
     *
     * @return Response
     */
    public function store(CreateVetRequest $request)
    {
        $input = $request->all();

        $vet = $this->vetRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/vets.singular')]));

        return redirect(route('adminPanel.vets.index'));
    }

    /**
     * Display the specified Vet.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vet = $this->vetRepository->find($id);

        if (empty($vet)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vets.singular')]));

            return redirect(route('adminPanel.vets.index'));
        }

        return view('adminPanel.vets.show')->with('vet', $vet);
    }

    /**
     * Show the form for editing the specified Vet.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vet = $this->vetRepository->find($id);
        $areas = Area::get()->pluck('text', 'id');


        if (empty($vet)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vets.singular')]));

            return redirect(route('adminPanel.vets.index'));
        }

        return view('adminPanel.vets.edit', compact('areas', 'vet'));
    }

    /**
     * Update the specified Vet in storage.
     *
     * @param int $id
     * @param UpdateVetRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVetRequest $request)
    {
        $vet = $this->vetRepository->find($id);

        if (empty($vet)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vets.singular')]));

            return redirect(route('adminPanel.vets.index'));
        }

        $vet = $this->vetRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/vets.singular')]));

        return redirect(route('adminPanel.vets.index'));
    }

    /**
     * Remove the specified Vet from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vet = $this->vetRepository->find($id);

        if (empty($vet)) {
            Flash::error(__('messages.not_found', ['model' => __('models/vets.singular')]));

            return redirect(route('adminPanel.vets.index'));
        }

        $this->vetRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/vets.singular')]));

        return redirect(route('adminPanel.vets.index'));
    }
}
