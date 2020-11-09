<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateWeightRequest;
use App\Http\Requests\AdminPanel\UpdateWeightRequest;
use App\Repositories\AdminPanel\WeightRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class WeightController extends AppBaseController
{
    /** @var  WeightRepository */
    private $weightRepository;

    public function __construct(WeightRepository $weightRepo)
    {
        $this->weightRepository = $weightRepo;
    }

    /**
     * Display a listing of the Weight.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $weights = $this->weightRepository->paginate(10);

        return view('adminPanel.weights.index')
            ->with('weights', $weights);
    }

    /**
     * Show the form for creating a new Weight.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.weights.create');
    }

    /**
     * Store a newly created Weight in storage.
     *
     * @param CreateWeightRequest $request
     *
     * @return Response
     */
    public function store(CreateWeightRequest $request)
    {
        $input = $request->all();

        $weight = $this->weightRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/weights.singular')]));

        return redirect(route('adminPanel.weights.index'));
    }

    /**
     * Display the specified Weight.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $weight = $this->weightRepository->find($id);

        if (empty($weight)) {
            Flash::error(__('messages.not_found', ['model' => __('models/weights.singular')]));

            return redirect(route('adminPanel.weights.index'));
        }

        return view('adminPanel.weights.show')->with('weight', $weight);
    }

    /**
     * Show the form for editing the specified Weight.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $weight = $this->weightRepository->find($id);

        if (empty($weight)) {
            Flash::error(__('messages.not_found', ['model' => __('models/weights.singular')]));

            return redirect(route('adminPanel.weights.index'));
        }

        return view('adminPanel.weights.edit')->with('weight', $weight);
    }

    /**
     * Update the specified Weight in storage.
     *
     * @param int $id
     * @param UpdateWeightRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWeightRequest $request)
    {
        $weight = $this->weightRepository->find($id);

        if (empty($weight)) {
            Flash::error(__('messages.not_found', ['model' => __('models/weights.singular')]));

            return redirect(route('adminPanel.weights.index'));
        }

        $weight = $this->weightRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/weights.singular')]));

        return redirect(route('adminPanel.weights.index'));
    }

    /**
     * Remove the specified Weight from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $weight = $this->weightRepository->find($id);

        if (empty($weight)) {
            Flash::error(__('messages.not_found', ['model' => __('models/weights.singular')]));

            return redirect(route('adminPanel.weights.index'));
        }

        $this->weightRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/weights.singular')]));

        return redirect(route('adminPanel.weights.index'));
    }
}
