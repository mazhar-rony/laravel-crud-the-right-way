<?php

namespace App\Services;

use App\Models\Offer;
use Illuminate\Support\Facades\DB;

class OfferService
{
    public function store(array $data, $image = null)
    {
        DB::transaction(function() use($data, $image) {
            $data = array_merge([
                'author_id' => auth()->user()->id,
            ], $data);

            $offer = Offer::create($data);

            $offer->categories()->sync($data['categories']);
            $offer->locations()->sync($data['locations']);

            if($image) {
                $offer->addMedia($image)
                    ->toMediaCollection();
            }
        }, 5);
    }
}