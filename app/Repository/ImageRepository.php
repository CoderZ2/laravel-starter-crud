<?php

namespace App\Repository;

use App\Models\Image;
use App\Repository\Repository;

class ImageRepository extends Repository
{
    public function getAll($filter)
    {
        return Image::when($filter['ids'] ?? false, function ($query, $ids) {
            $query->whereIn('id', $ids);
        })
        ->get();
    }

    public function deleteMany($ids)
    {
        if(!empty($ids)) {
            Image::whereIn('id', $ids)->delete();
        }
    }
}
