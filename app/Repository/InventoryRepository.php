<?php
namespace App\Repository;

use App\Models\Store;
use App\Repository\Repository;

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
}
