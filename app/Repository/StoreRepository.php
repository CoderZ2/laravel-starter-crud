<?php
namespace App\Repository;

use App\Models\Store;
use App\Repository\Repository;
use Mockery\Matcher\Any;

class StoreRepository extends Repository
{
    /**
     * @return array
     */
    public function getAll(): array
    {
        $stores = Store::get();
        return compact('stores');
    }

    /**
     * @param array
     * @return Store
     */
    public function store(array $data, $images): Any
    {   
        return Store::create($data)->images()->saveMany($images);
    }
}
