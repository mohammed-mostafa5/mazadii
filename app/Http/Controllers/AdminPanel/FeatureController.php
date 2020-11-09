<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateFeatureRequest;
use App\Http\Requests\AdminPanel\UpdateFeatureRequest;
use App\Repositories\AdminPanel\FeatureRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FeatureController extends AppBaseController
{
    /** @var  FeatureRepository */
    private $featureRepository;

    public function __construct(FeatureRepository $featureRepo)
    {
        $this->featureRepository = $featureRepo;
    }

    /**
     * Display a listing of the Feature.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $features = $this->featureRepository->all();

        return view('adminPanel.features.index')
            ->with('features', $features);
    }

    /**
     * Show the form for creating a new Feature.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.features.create');
    }

    /**
     * Store a newly created Feature in storage.
     *
     * @param CreateFeatureRequest $request
     *
     * @return Response
     */
    public function store(CreateFeatureRequest $request)
    {
        $input = $request->all();

        $feature = $this->featureRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/features.singular')]));

        return redirect(route('adminPanel.features.index'));
    }

    /**
     * Display the specified Feature.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));

            return redirect(route('adminPanel.features.index'));
        }

        return view('adminPanel.features.show')->with('feature', $feature);
    }

    /**
     * Show the form for editing the specified Feature.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));

            return redirect(route('adminPanel.features.index'));
        }

        return view('adminPanel.features.edit')->with('feature', $feature);
    }

    /**
     * Update the specified Feature in storage.
     *
     * @param int $id
     * @param UpdateFeatureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeatureRequest $request)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));

            return redirect(route('adminPanel.features.index'));
        }

        $feature = $this->featureRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/features.singular')]));

        return redirect(route('adminPanel.features.index'));
    }

    /**
     * Remove the specified Feature from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));

            return redirect(route('adminPanel.features.index'));
        }

        $this->featureRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/features.singular')]));

        return redirect(route('adminPanel.features.index'));
    }
}
