<?php

namespace App\Http\Controllers\API;

use App\BicycleAccessory;
use App\Category;
use App\Country;
use App\Producer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccessoryController extends Controller
{
    /**
     * Display a listing of the Accesories
     * @author Efrain Es
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        try{
            $accessories = BicycleAccessory::with(['category','country','producer','images','pdfs'])->get();
            $catalogues['categories'] = Category::all();
            $catalogues['countries'] = Country::all();
            $catalogues['producers'] = Producer::all();
            return response()->json(['code'=>200,'status'=>'ok','message'=>'All Accessories','data'=>$accessories,'catalogues'=>$catalogues]);
        }catch (\Exception $exception){
            return response()->json(['code'=>400,'error'=>$exception->getMessage()]);
        }
    }

    /**
     * Create a Accessory.
     * @author Efrain Es
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        try{
            $validator = Validator::make($request->all(), [
                'sku' => 'required|unique:bicycle_accessories|max:255',
                'description' => 'required|max:255',
                'category_id' => 'required',
                'country_id' => 'required',
                'producer_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $accessory = new BicycleAccessory();
            $accessory->sku = $request->sku;
            $accessory->description = $request->description;
            $accessory->category_id = $request->category_id;
            $accessory->country_id = $request->country_id;
            $accessory->producer_id = $request->producer_id;
            $accessory->save();

            $accessory->load(['country','category','producer','images','pdfs']);
            return response()->json(['code'=>200,'status'=>'ok','message'=>'Accessory Created!','data'=>$accessory]);
        }catch (\Exception $exception){
            return response()->json(['code'=>400,'error'=>$exception->getMessage()],400);
        }
    }

    /**
     * Display the specified Accessory
     * @author Efrain Es
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        try{
            $accessory = BicycleAccessory::find($id);
            return response()->json(['code'=>200,'status'=>'ok','message'=>'Show Accesory!','data'=>$accessory]);
        }catch (\Exception $exception){
            return response()->json(['code'=>400,'error'=>$exception->getMessage()],400);
        }
    }

    /**
     * Update the specified Accessory
     * @author Efrain Es
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $accessory = BicycleAccessory::find($id);
            $accessory->sku = $request->sku;
            $accessory->description = $request->description;
            $accessory->category_id = $request->category_id;
            $accessory->country_id = $request->country_id;
            $accessory->producer_id = $request->producer_id;
            $accessory->save();

            $accessory->load(['country','category','producer','images','pdfs']);
            return response()->json(['code'=>200,'status'=>'ok','message'=>'Accessory Updated!','data'=>$accessory]);
        }catch (\Exception $exception){
            return response()->json(['code'=>400,'error'=>$exception->getMessage()],400);
        }
    }

    /**
     * Remove the specified Accesory
     * @author Efrain Es
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        try{
            BicycleAccessory::find($id)->delete();
            return response()->json(['code'=>200,'status'=>'ok','message'=>'Accessory Deleted!']);
        }catch (\Exception $exception){
            return response()->json(['code'=>400,'error'=>$exception->getMessage()],400);
        }
    }
}
