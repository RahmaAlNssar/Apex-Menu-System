<?php

namespace App\Http\Controllers\Api\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDataTable;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Http\Controllers\BackendController;
use App\Http\Resources\CategoryResource;
use App\Traits\ResponseTrait;

class CategoryController extends Controller
{
    use ResponseTrait;
    function __construct()
    {
        $this->middleware('role:admin|restaurant');
    }
    public function index()
    {
        try {
            $data = CategoryResource::collection(Category::with('images')->orderBy('id', 'desc')->paginate(25));
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
    public function store(CategoryRequest $request, CategoryService $service)
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
    public function update(CategoryRequest $request, $id, CategoryService $service)
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
            $row = Category::where('id', $id)->first();
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
