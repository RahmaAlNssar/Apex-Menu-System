<?php

namespace App\Http\Controllers\Api\Backend;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    use ResponseTrait;
    function __construct()
    {
        $this->middleware('role:admin|restaurant');
    }
    public function index()
    {
        try {
            $data = FeedbackResource::collection(Feedback::orderBy('id', 'desc')->paginate(25));
            return $this->returnData($data, true, 200);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage(), 500);
        }
    }
}
