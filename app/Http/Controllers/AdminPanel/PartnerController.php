<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreatePartnerRequest;
use App\Http\Requests\AdminPanel\UpdatePartnerRequest;
use App\Repositories\AdminPanel\PartnerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PartnerController extends AppBaseController
{
    /** @var  PartnerRepository */
    private $partnerRepository;

    public function __construct(PartnerRepository $partnerRepo)
    {
        $this->partnerRepository = $partnerRepo;
    }

    /**
     * Display a listing of the Partner.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $partners = $this->partnerRepository->paginate(10);

        return view('adminPanel.partners.index')
            ->with('partners', $partners);
    }

    /**
     * Show the form for creating a new Partner.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.partners.create');
    }

    /**
     * Store a newly created Partner in storage.
     *
     * @param CreatePartnerRequest $request
     *
     * @return Response
     */
    public function store(CreatePartnerRequest $request)
    {
        $input = $request->all();

        $partner = $this->partnerRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/partners.singular')]));

        return redirect(route('adminPanel.partners.index'));
    }

    /**
     * Display the specified Partner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            Flash::error(__('messages.not_found', ['model' => __('models/partners.singular')]));

            return redirect(route('adminPanel.partners.index'));
        }

        return view('adminPanel.partners.show')->with('partner', $partner);
    }

    /**
     * Show the form for editing the specified Partner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            Flash::error(__('messages.not_found', ['model' => __('models/partners.singular')]));

            return redirect(route('adminPanel.partners.index'));
        }

        return view('adminPanel.partners.edit')->with('partner', $partner);
    }

    /**
     * Update the specified Partner in storage.
     *
     * @param int $id
     * @param UpdatePartnerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePartnerRequest $request)
    {
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            Flash::error(__('messages.not_found', ['model' => __('models/partners.singular')]));

            return redirect(route('adminPanel.partners.index'));
        }

        $partner = $this->partnerRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/partners.singular')]));

        return redirect(route('adminPanel.partners.index'));
    }

    /**
     * Remove the specified Partner from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            Flash::error(__('messages.not_found', ['model' => __('models/partners.singular')]));

            return redirect(route('adminPanel.partners.index'));
        }

        $this->partnerRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/partners.singular')]));

        return redirect(route('adminPanel.partners.index'));
    }
}
