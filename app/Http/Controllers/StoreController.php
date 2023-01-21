<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Category;
use App\Repository\StoreRepository;
use App\Services\ImageService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct(protected StoreRepository $storeRepository, protected ImageService $imageService)
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->storeRepository()->getAll();
        return view('pages.store.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        session()->reflash('persists');

        if (!session('persists')) {
            session()->forget(['base64Images', 'confirm', 'createData']);
        }

        $categories = Category::toBase()->get();

        return view('pages.store.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $images = $this->imageService->base64Decode(session('base64Images', []));
        $this->storeRepository->store(session('createData', []), $images);
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
            return to_route('store.create');
        }

        return view('pages.store.confirm');
    }

    public function postConfirm(StoreRequest $request)
    {
        session()->flash('createData', array_merge($request->safe()->only(['name', 'price', 'category_id', 'description', 'total'])));
        return to_route('store.confirm');
    }
}
