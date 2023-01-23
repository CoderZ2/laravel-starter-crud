<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Category;
use App\Repository\ImageRepository;
use App\Repository\InventoryRepository;
use App\Services\ImageService;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class InventoryController extends Controller
{
    public function __construct(
        protected InventoryRepository $inventoryRepository,
        protected ImageService $imageService,
        protected ImageRepository $imageRepository,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->inventoryRepository->getAll($request->search);
        return view('pages.inventory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!session('persists')) {
            session()->forget(['base64Images', 'confirm', 'createData']);
        }

        $categories = Category::toBase()->get();

        return view('pages.inventory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $images = $this->imageService->base64Decode(session('base64Images', []));
        $this->inventoryRepository->store(session('createData', []), $images);
        session()->forget(['base64Images', 'confirm', 'createData']);
        return to_route('inventory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!session()->has('persists')) {
            session()->forget(['editInventoryData', 'oldImages', 'base64Images']);
        }
        $data = $this->inventoryRepository->edit($id);
        session()->put('oldImages', $data['store']->images->toArray());
        return view('pages.inventory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $images = $this->imageService->base64Decode(session('base64Images', []));
        $data = session('editInventoryData');
        $this->inventoryRepository->update($data, $images, $this->imageRepository);
        session()->forget(['base64Images', 'confirm', 'editInventoryData', 'persists']);
        return to_route('inventory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirm()
    {
        session()->keep(['persists', 'createData']);
        if (!session()->has('persists')) {
            return to_route('inventory.create');
        }

        return view('pages.inventory.confirm');
    }

    public function postConfirm(StoreRequest $request)
    {
        session()->flash('createData', $request->safe()->only(
            [
                'name',
                'price',
                'category_id',
                'description',
                'total'
            ]
        ));
        return to_route('inventory.confirm');
    }

    public function updateConfirm(UpdateInventoryRequest $request)
    {
        if ($request->isMethod('POST')) {
            session()->flash('persists');
            $bas64Images = collect(session('base64Images'))
                ->whereNotIn('id', $request->input('deleteImageIds', []))
                ->toArray();
            session()->put('base64Images', $bas64Images);
            session()->flash('editInventoryData', $request->except(['_token', '_method']));
            return to_route('inventory.update-confirm');
        }

        if ($request->isMethod('GET')) {
            if (!session()->has('persists')) {
                return to_route('inventory.create');
            }
            session()->keep(['editInventoryData', 'persists']);
            return view('pages.inventory.edit-confirm');
        }
    }
}
