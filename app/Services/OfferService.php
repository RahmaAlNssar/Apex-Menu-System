<?php

namespace App\Services;

use App\Models\Offer;
use App\Traits\ResponseTrait;
use App\Traits\uploadImage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OfferService
{
    use uploadImage, ResponseTrait;

    public function handle($request, $id = null)
    {

        try {
            DB::beginTransaction();
            $row = Offer::updateOrCreate(['id' => $id], $request);

            if (!empty($request['image'])) {
                foreach ($request['image'] as $img) {
                    $fileData = $this->uploads($img, 'uploads/items/');
                    foreach ($row->images as $img1) {
                        $img1->delete();
                    }
                    $row->images()->create(['image' => $fileData['fileName']]);
                }
            }
            DB::commit();
            return [$row, $row->images];
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->returnError($e->getMessage(), 500);
        }
    }
}
