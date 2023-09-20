<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Models\Item;
use App\Models\Offer;
use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\Resources\OfferResource;
use App\Http\Requests\FeedbackRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    use ResponseTrait;
    public function categories()
    {
        try{
            $data = CategoryResource::collection(Category::with('images')->paginate());
            return $this->returnData($data,true,200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function offers()
    {
        try{
            $data = OfferResource::collection(Offer::with('images')->paginate());
            return $this->returnData($data,true,200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function items(Request $request)
    {
        try{
            
            $lang = $request->header('Accept-Language');
            $data = ItemResource::collection(Item::with('images','category')->whereHas('category',function($q) use($lang,$request){
                $q->where('name_'.$lang,$request->category);
            })->get());
            
            return $this->returnData($data,true,200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function search(Request $request)
    {
        try{
            $lang = $request->header('Accept-Language');
            $data = ItemResource::collection(Item::with('images')->when($request->item,function($query) use($request,$lang){
                 $query->where('name_'.$lang,'like',"%{$request->item}%")->get();
            })->get());
            return $this->returnData($data,true,200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function getItem($id)
    {
        try{
         
            $data = ItemResource::collection(Item::with('images')->where('id',$id)->get());
            return $this->returnData($data,true,200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store_feedback(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'comment'=>'required',
            'rating_service'=>'required',
            'rating_hygiene'=>'required',
            'rating_staff'=>'required',
            'email'=>'email|regex:/(.+)@(.+)\.(.+)/i|nullable|string|unique:feedback,email,except,id',
            'phone'=>'nullable|numeric|unique:feedback,phone,except,id'
        ]);
        if ($validator->fails()) {
            return $this->returnError(
                $validator->errors(),
                 422,
            );
        }
        try{
            if(is_numeric($request->get('email_or_phone'))){
                Feedback::create(array_merge($request->except('phone'),['phone'=>$request->email_or_phone]));
            } elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                Feedback::create(array_merge($request->except('email'),['email'=>$request->email_or_phone]));

            }else{
                Feedback::create(array_merge($request->except('email'),['email'=>$request->email_or_phone]));
            }

            return $this->returnSuccess(__('messages.success'),200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

}
