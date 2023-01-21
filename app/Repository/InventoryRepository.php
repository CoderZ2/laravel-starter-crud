<?php
namespace App\Repository;

use App\Models\Store;
use App\Repository\Repository;

class InventoryRepository extends Repository
{
    /**
     * @return array
     */
    public function getAll(): array
    {
        $stores = Store::with('images')->get();
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
