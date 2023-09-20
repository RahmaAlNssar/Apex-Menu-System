<?php

namespace App\Services;

use App\Http\Requests\CategoryRequest;
use App\Models\Admin;
use App\Models\Code;
use App\Models\Image;
use App\Traits\ResponseTrait;
use App\Traits\uploadImage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class AdminService
{
    use uploadImage, ResponseTrait;

    public function handle($request, $id = null)
    {

        try {
            DB::beginTransaction();
            if (!empty($request['password'])) {
                $request['password'] = Hash::make($request['password']);
            } else {
                unset($request['password']);
            }
            $request['added_by'] = auth()->id();
            $row = Admin::updateOrCreate(['id' => $id], $request);
            $row->assignRole('restaurant');

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
