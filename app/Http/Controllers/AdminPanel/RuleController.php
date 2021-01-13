<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateRuleRequest;
use App\Http\Requests\AdminPanel\UpdateRuleRequest;
use App\Repositories\AdminPanel\RuleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class RuleController extends AppBaseController
{
    /** @var  RuleRepository */
    private $ruleRepository;

    public function __construct(RuleRepository $ruleRepo)
    {
        $this->ruleRepository = $ruleRepo;
    }

    /**
     * Display a listing of the Rule.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $rules = $this->ruleRepository->all();

        return view('adminPanel.rules.index')
            ->with('rules', $rules);
    }

    /**
     * Show the form for creating a new Rule.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.rules.create');
    }

    /**
     * Store a newly created Rule in storage.
     *
     * @param CreateRuleRequest $request
     *
     * @return Response
     */
    public function store(CreateRuleRequest $request)
    {
        $input = $request->all();

        $rule = $this->ruleRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/rules.singular')]));

        return redirect(route('adminPanel.rules.index'));
    }

    /**
     * Display the specified Rule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $rule = $this->ruleRepository->find($id);

        if (empty($rule)) {
            Flash::error(__('messages.not_found', ['model' => __('models/rules.singular')]));

            return redirect(route('adminPanel.rules.index'));
        }

        return view('adminPanel.rules.show')->with('rule', $rule);
    }

    /**
     * Show the form for editing the specified Rule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $rule = $this->ruleRepository->find($id);

        if (empty($rule)) {
            Flash::error(__('messages.not_found', ['model' => __('models/rules.singular')]));

            return redirect(route('adminPanel.rules.index'));
        }

        return view('adminPanel.rules.edit')->with('rule', $rule);
    }

    /**
     * Update the specified Rule in storage.
     *
     * @param int $id
     * @param UpdateRuleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRuleRequest $request)
    {
        $rule = $this->ruleRepository->find($id);

        if (empty($rule)) {
            Flash::error(__('messages.not_found', ['model' => __('models/rules.singular')]));

            return redirect(route('adminPanel.rules.index'));
        }

        $rule = $this->ruleRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/rules.singular')]));

        return redirect(route('adminPanel.rules.index'));
    }

    /**
     * Remove the specified Rule from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $rule = $this->ruleRepository->find($id);

        if (empty($rule)) {
            Flash::error(__('messages.not_found', ['model' => __('models/rules.singular')]));

            return redirect(route('adminPanel.rules.index'));
        }

        $this->ruleRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/rules.singular')]));

        return redirect(route('adminPanel.rules.index'));
    }
}
