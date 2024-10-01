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

    public function update(Offer $offer, array $data, $image = null)
    {
        DB::transaction(function() use($offer, $data, $image) {
            $data = array_merge([
                'author_id' => auth()->user()->id,
            ], $data);

            $offer = tap($offer)->update($data);

            $offer->categories()->sync($data['categories']);
            $offer->locations()->sync($data['locations']);

            if($image) {
                $offer->addMedia($image)
                    ->toMediaCollection();
            }
        }, 5);
    }

    public function destroy(Offer $offer)
    {
        $offer->update([
            'deleted_by' => auth()->user()->id,
            'deleted_at' => now()
        ]);
    }
}