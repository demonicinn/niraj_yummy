<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use App\Models\Preferences;

class PreferencesController extends BaseController
{
    //...get
    public function index(Request $request): JsonResponse
    {
        $user = auth()->user();
        $preferencesData = Preferences::where('user_id', $user->id)->first();
        if($preferencesData && $preferencesData->data != ''){
            $preferencesData->data = json_decode($preferencesData->data);
        }

        return $this->sendResponse($preferencesData, 'Preferences retrieved successfully.');
    }

    //...store
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'data.*.key' => 'required',
            'data.*.value' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        
        $user = auth()->user();
        $preferencesData = Preferences::where('user_id', $user->id)->first();

        $store = new Preferences;
        if($preferencesData){
            $store->id = $preferencesData->id;
            $store->exists = true;
        }
        $store->user_id = $user->id;
        $store->data = json_encode($request->data);
        $store->save();
        
        $store->data = json_decode($store->data);

        return $this->sendResponse($store, 'Preferences updated successfully.');
    }
}
