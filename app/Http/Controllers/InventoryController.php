<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Category;
use App\Repository\InventoryRepository;
use App\Services\ImageService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(protected InventoryRepository $inventoryRepository, protected ImageService $imageService)
    {

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        session()->flash('createData', array_merge($request->safe()->only(['name', 'price', 'category_id', 'description', 'total'])));
        return to_route('inventory.confirm');
    }
}
