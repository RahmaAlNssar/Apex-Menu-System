<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\OptionProduct;
use App\Traits\ResponseTrait;
use Composer\Util\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class BackendController extends Controller
{
    use ResponseTrait;
    // public function __construct(public DataTable $dataTable, public Model $model)
    // {
    //     //
    // }

    public function __construct(public Model $model)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $query = $this->model::query();
            $data = $query->orderBy('id', 'desc')->paginate(25);

            return view('backend.' . $this->model->getTable() . '.index', compact('data'), $this->append());
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            return view('backend.' . $this->model->getTable() . '.form', $this->append());
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $row = $this->model::query()->where('id', $id)->first();

            return view('backend.' . $this->model->getTable() . '.form', compact('row'), $this->append());
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $row = $this->model::where('id', $id)->first();

            if (isset($row->images)) {
                foreach ($row->images as $img) {

                    $img->delete();
                }
            }
            $row->delete();
            return response()->json(['title' => 'نجاح', 'message' => 'تم الحذف بنجاح', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function updateStatus($id, $column)
    {
        try {

            $row = $this->model::where('id', $id)->first();
            $row->update([$column => !$row->$column]);
            return response()->json(['title' => 'نجاح', 'message' => 'تم تحديث الحاله بنجاح', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function MultiDelete(Request $request)
    {

        try {

            $rows = $this->model::whereIn('id', (array)$request['id'])->delete();

            // dd($rows);
            //    DB::beginTransaction();
            //    foreach ($rows as $row)
            //        $row->delete();
            //    DB::commit();
            return response()->json(['title' => 'نجاح', 'message' => 'تم الحذف بنجاح', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $row = $this->model::query()->where('id', $id)->first();

            return view('backend.' . $this->model->getTable() . '.show', compact('row'), $this->append());
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $data = $this->model::Search($request->search)->paginate();

            return response()->json([
                'html'  => view('backend.' . $this->model->getTable() . '.search', ['data' => $data])->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function append()
    {
        return [];
    }
}
