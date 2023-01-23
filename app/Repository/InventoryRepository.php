<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Store;
use App\Repository\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class InventoryRepository extends Repository
{
    /**
     * @param string
     * @return array
     */
    public function getAll($search): array
    {
        $stores = Store::latest()->with('images')->when($search, function ($query, $search) {
            $pattern = '%' . $search . '%';
            $query->where('name', 'like', $pattern)
                ->orWhereHas('category', function ($query) use ($pattern) {
                    $query->where('name', 'like', $pattern);
                });
        })
            ->get();
        return compact('stores');
    }

    /**
     * @param array
     * @return Store
     */
    public function store(array $data, $images)
    {
        return Store::create($data)->images()->saveMany($images);
    }

    public function edit($id)
    {
        $categories = Category::toBase()->get();
        $pattern = session('editInventoryData')['deleteOldImageIds'] ?? false;
        $store = Store::with(['images' => function ($query)  use ($pattern) {
            return $query->when($pattern, function ($query, $deleteOldImageIds) {
                $query->whereNotIn('id', $deleteOldImageIds);
            });
        }])->findOrFail($id);

        return compact('store', 'categories');
    }

    public function update($data, $images, $imageRepository)
    {
        DB::beginTransaction();
        try {
            Store::where('id', $data['id'])->update(
                [
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'category_id' => $data['category_id'],
                    'description' => $data['description'] ?? []
                ]
            );


            Store::find($data['id'])->images()->saveMany($images);

            $urls = [];

            if (isset($data['deleteOldImageIds'])) {
                $urls = $imageRepository->getAll(['ids' => $data['deleteOldImageIds']])
                    ->pluck('url')
                    ->toArray();
            }

            $imageRepository->deleteMany($data['deleteOldImageIds'] ?? []);

            DB::commit();

            if (!empty($urls)) {
                Storage::delete($urls);
            }
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            abort(500);
        }
    }
}
