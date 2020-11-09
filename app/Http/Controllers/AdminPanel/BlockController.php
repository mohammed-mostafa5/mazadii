<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateBlockRequest;
use App\Http\Requests\AdminPanel\UpdateBlockRequest;
use App\Repositories\AdminPanel\BlockRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Page;
use Illuminate\Http\Request;
use Flash;
use Response;

class BlockController extends AppBaseController
{
    /** @var  BlockRepository */
    private $blockRepository;

    public function __construct(BlockRepository $blockRepo)
    {
        $this->blockRepository = $blockRepo;
    }

    /**
     * Display a listing of the Block.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $blocks = $this->blockRepository->all();

        return view('adminPanel.blocks.index')
            ->with('blocks', $blocks);
    }

    /**
     * Show the form for creating a new Block.
     *
     * @return Response
     */
    public function create()
    {
        $pages = Page::get()->pluck('name', 'id');
        return view('adminPanel.blocks.create', compact('pages'));
    }

    /**
     * Store a newly created Block in storage.
     *
     * @param CreateBlockRequest $request
     *
     * @return Response
     */
    public function store(CreateBlockRequest $request)
    {
        $input = $request->all();

        $block = $this->blockRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/blocks.singular')]));

        return redirect(route('adminPanel.blocks.index'));
    }

    /**
     * Display the specified Block.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $block = $this->blockRepository->find($id);

        if (empty($block)) {
            Flash::error(__('messages.not_found', ['model' => __('models/blocks.singular')]));

            return redirect(route('adminPanel.blocks.index'));
        }

        return view('adminPanel.blocks.show')->with('block', $block);
    }

    /**
     * Show the form for editing the specified Block.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $block = $this->blockRepository->find($id);
        $pages = Page::get()->pluck('name', 'id');
        if (empty($block)) {
            Flash::error(__('messages.not_found', ['model' => __('models/blocks.singular')]));

            return redirect(route('adminPanel.blocks.index'));
        }

        return view('adminPanel.blocks.edit', compact('pages', 'block'));
    }

    /**
     * Update the specified Block in storage.
     *
     * @param int $id
     * @param UpdateBlockRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBlockRequest $request)
    {
        $block = $this->blockRepository->find($id);

        if (empty($block)) {
            Flash::error(__('messages.not_found', ['model' => __('models/blocks.singular')]));

            return redirect(route('adminPanel.blocks.index'));
        }

        $block = $this->blockRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/blocks.singular')]));

        return redirect(route('adminPanel.blocks.index'));
    }

    /**
     * Remove the specified Block from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $block = $this->blockRepository->find($id);

        if (empty($block)) {
            Flash::error(__('messages.not_found', ['model' => __('models/blocks.singular')]));

            return redirect(route('adminPanel.blocks.index'));
        }

        $this->blockRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/blocks.singular')]));

        return redirect(route('adminPanel.blocks.index'));
    }
}
