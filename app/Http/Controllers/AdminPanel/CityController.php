<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateCityRequest;
use App\Http\Requests\AdminPanel\UpdateCityRequest;
use App\Repositories\AdminPanel\CityRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Flash;
use Response;

class CityController extends AppBaseController
{
    /** @var  CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
    }

    /**
     * Display a listing of the City.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Country $country)
    {
        $cities = City::where('country_id', $country->id)->get();

        return view('adminPanel.cities.index', compact('cities', 'country'));
    }

    /**
     * Show the form for creating a new City.
     *
     * @return Response
     */
    public function create(Country $country)
    {
        return view('adminPanel.cities.create', compact('country'));
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return Response
     */
    public function store(CreateCityRequest $request, Country $country)
    {
        $input = $request->all();
        $input['country_id'] = $country->id;

        $city = $this->cityRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/cities.singular')]));

        return redirect(route('adminPanel.countries.cities.index', $country->id));
    }

    /**
     * Display the specified City.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cities.singular')]));

            return redirect(route('adminPanel.cities.index'));
        }

        return view('adminPanel.cities.show')->with('city', $city);
    }

    /**
     * Show the form for editing the specified City.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, Country $country)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cities.singular')]));

            return back();
        }

        return view('adminPanel.cities.edit', compact('city', 'country'));
    }

    /**
     * Update the specified City in storage.
     *
     * @param int $id
     * @param UpdateCityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCityRequest $request)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cities.singular')]));

            return back();
        }

        $city = $this->cityRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/cities.singular')]));

        return redirect(route('adminPanel.countries.cities.index', $city->country_id));
    }

    /**
     * Remove the specified City from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error(__('messages.not_found', ['model' => __('models/cities.singular')]));

            return back();
        }

        $this->cityRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/cities.singular')]));

        return back();
    }
}
