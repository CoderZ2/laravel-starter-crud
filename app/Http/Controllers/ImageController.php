<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;
use Throwable;

class ImageController extends Controller
{
    protected $ImageService;
    public function __construct(protected ImageService $imageService)
    {

    }

    public function preUpload(Request $request)
    {   
        session()->reflash('persists');
        try {
            if ($request->hasFile('image')) {
                $base64EncodedImages = $this->imageService->base64Encode($request->image);
                session()->put('base64Images', array_merge(session()->get('base64Images', []), [$base64EncodedImages]));
                return response()->json(['id' => $base64EncodedImages['id']]);
            }
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
