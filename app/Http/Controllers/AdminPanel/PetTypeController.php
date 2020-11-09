<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreatePetTypeRequest;
use App\Http\Requests\AdminPanel\UpdatePetTypeRequest;
use App\Repositories\AdminPanel\PetTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PetTypeController extends AppBaseController
{
    /** @var  PetTypeRepository */
    private $petTypeRepository;

    public function __construct(PetTypeRepository $petTypeRepo)
    {
        $this->petTypeRepository = $petTypeRepo;
    }

    /**
     * Display a listing of the PetType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $petTypes = $this->petTypeRepository->paginate(10);

        return view('adminPanel.pet_types.index')
            ->with('petTypes', $petTypes);
    }

    /**
     * Show the form for creating a new PetType.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.pet_types.create');
    }

    /**
     * Store a newly created PetType in storage.
     *
     * @param CreatePetTypeRequest $request
     *
     * @return Response
     */
    public function store(CreatePetTypeRequest $request)
    {
        $input = $request->all();

        $petType = $this->petTypeRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/petTypes.singular')]));

        return redirect(route('adminPanel.petTypes.index'));
    }

    /**
     * Display the specified PetType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $petType = $this->petTypeRepository->find($id);

        if (empty($petType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/petTypes.singular')]));

            return redirect(route('adminPanel.petTypes.index'));
        }

        return view('adminPanel.pet_types.show')->with('petType', $petType);
    }

    /**
     * Show the form for editing the specified PetType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $petType = $this->petTypeRepository->find($id);

        if (empty($petType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/petTypes.singular')]));

            return redirect(route('adminPanel.petTypes.index'));
        }

        return view('adminPanel.pet_types.edit')->with('petType', $petType);
    }

    /**
     * Update the specified PetType in storage.
     *
     * @param int $id
     * @param UpdatePetTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetTypeRequest $request)
    {
        $petType = $this->petTypeRepository->find($id);

        if (empty($petType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/petTypes.singular')]));

            return redirect(route('adminPanel.petTypes.index'));
        }

        $petType = $this->petTypeRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/petTypes.singular')]));

        return redirect(route('adminPanel.petTypes.index'));
    }

    /**
     * Remove the specified PetType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $petType = $this->petTypeRepository->find($id);

        if (empty($petType)) {
            Flash::error(__('messages.not_found', ['model' => __('models/petTypes.singular')]));

            return redirect(route('adminPanel.petTypes.index'));
        }

        $this->petTypeRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/petTypes.singular')]));

        return redirect(route('adminPanel.petTypes.index'));
    }
}
