<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;

use App\Http\Resources\AdminResource;
use App\Http\Resources\SubscriptionResource;
use App\Http\Resources\ThemeResource;
use App\Models\Admin;
use App\Models\Subscription;
use App\Models\Theme;
use App\Services\AdminService;
use App\Traits\ResponseTrait;
use App\Traits\uploadImage;
use Illuminate\Http\Request;
use \Exception;

class AdminController extends Controller
{
    use ResponseTrait;
    use uploadImage;
    function __construct()
    {
        $this->middleware('role:admin');
        // $this->middleware('can:admins-index|admins-create|admins-edit|admins-destroy');
    }
    public function index()
    {
        try {
            $data = AdminResource::collection(Admin::whereHas('roles', function ($q) {
                $q->where('name', 'restaurant');
            })->with('subscription')->orderBy('id', 'desc')->paginate(25));
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), 500);
        }
    }

    public function getSubscriptions()
    {
        try {
            $data = SubscriptionResource::collection(Subscription::orderBy('id', 'desc')->paginate(25));
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), 500);
        }
    }

    public function getThemes()
    {

        try {

            $data = ThemeResource::collection(Theme::orderBy('id', 'desc')->paginate(25));
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
    public function store(AdminRequest $request, AdminService $service)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id, AdminService $service)
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
            $row = Admin::where('id', $id)->first();
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
