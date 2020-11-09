<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateGenderRequest;
use App\Http\Requests\AdminPanel\UpdateGenderRequest;
use App\Repositories\AdminPanel\GenderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class GenderController extends AppBaseController
{
    /** @var  GenderRepository */
    private $genderRepository;

    public function __construct(GenderRepository $genderRepo)
    {
        $this->genderRepository = $genderRepo;
    }

    /**
     * Display a listing of the Gender.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $genders = $this->genderRepository->paginate(10);

        return view('adminPanel.genders.index')
            ->with('genders', $genders);
    }

    /**
     * Show the form for creating a new Gender.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.genders.create');
    }

    /**
     * Store a newly created Gender in storage.
     *
     * @param CreateGenderRequest $request
     *
     * @return Response
     */
    public function store(CreateGenderRequest $request)
    {
        $input = $request->all();

        $gender = $this->genderRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/genders.singular')]));

        return redirect(route('adminPanel.genders.index'));
    }

    /**
     * Display the specified Gender.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gender = $this->genderRepository->find($id);

        if (empty($gender)) {
            Flash::error(__('messages.not_found', ['model' => __('models/genders.singular')]));

            return redirect(route('adminPanel.genders.index'));
        }

        return view('adminPanel.genders.show')->with('gender', $gender);
    }

    /**
     * Show the form for editing the specified Gender.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gender = $this->genderRepository->find($id);

        if (empty($gender)) {
            Flash::error(__('messages.not_found', ['model' => __('models/genders.singular')]));

            return redirect(route('adminPanel.genders.index'));
        }

        return view('adminPanel.genders.edit')->with('gender', $gender);
    }

    /**
     * Update the specified Gender in storage.
     *
     * @param int $id
     * @param UpdateGenderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGenderRequest $request)
    {
        $gender = $this->genderRepository->find($id);

        if (empty($gender)) {
            Flash::error(__('messages.not_found', ['model' => __('models/genders.singular')]));

            return redirect(route('adminPanel.genders.index'));
        }

        $gender = $this->genderRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/genders.singular')]));

        return redirect(route('adminPanel.genders.index'));
    }

    /**
     * Remove the specified Gender from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gender = $this->genderRepository->find($id);

        if (empty($gender)) {
            Flash::error(__('messages.not_found', ['model' => __('models/genders.singular')]));

            return redirect(route('adminPanel.genders.index'));
        }

        $this->genderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/genders.singular')]));

        return redirect(route('adminPanel.genders.index'));
    }
}
