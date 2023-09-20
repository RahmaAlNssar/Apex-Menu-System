<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Services\ItemService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    use ResponseTrait;
    function __construct()
    {
        $this->middleware('role:admin|restaurant');
    }
    public function index()
    {
        try {
            $data = ItemResource::collection(Item::with('images')->orderBy('id', 'desc')->paginate(25));
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request, ItemService $service)
    {

        try {
            $row = $service->handle($request->all());

            if (is_string($row)) return $this->throwException($row);
            return $this->returnSuccess(__('messages.saved success'), 200);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id, ItemService $service)
    {

        try {
            $row = $service->handle($request->all(), $id);

            if (is_string($row)) return $this->throwException($row);
            return $this->returnSuccess(__('messages.update success'), 200);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $row = Item::where('id', $id)->first();
            if ($row) {
                $row->delete();
            } else {
                return $this->returnError(__('messages.undefiend'), 404);
            }

            return $this->returnSuccess(__('messages.update success'), 200);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), 500);
        }
    }
}
