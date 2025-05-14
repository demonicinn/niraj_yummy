<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use App\Models\Groups;
use App\Models\GroupUsers;

class GroupsController extends BaseController
{
    //...get
    public function index(Request $request): JsonResponse
    {
        $user = auth()->user();
        // $data['active'] = Groups::where('user_id', $user->id)->where('status', '1')->get();
        // $data['past'] = Groups::where('user_id', $user->id)->where('status', '0')->get();


        $data['active'] = Groups::whereHas('groupUsers', function($query) use ($user){
                $query->where('user_id', $user->id);
            })
            ->where('status', '1')
            ->with('user:id,first_name,last_name,image')
            ->get();

        $data['past'] = Groups::whereHas('groupUsers', function($query) use ($user){
                $query->where('user_id', $user->id);
            })
            ->where('status', '0')
            ->with('user:id,first_name,last_name,image')
            ->get();

        return $this->sendResponse($data, 'Groups retrieved successfully.');
    }

    //...store
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        //...
        $unique_code = uniqueCode();

        $user = auth()->user();
        
        $store = new Groups;
        $store->unique_code = $unique_code;
        $store->user_id = $user->id;
        $store->name = $request->name;
        $store->status = '1';
        $store->save();

        //...
        $gUser = new GroupUsers;
        $gUser->group_id = $store->id;
        $gUser->user_id = $user->id;
        $gUser->save();
        

        return $this->sendResponse($store, 'Groups created successfully.');
    }


    //...magic
    public function magic(Request $request): JsonResponse
    {
        $user = auth()->user();
        $group = Groups::where('user_id', $user->id)->where('unique_code', $request->code)->where('status', '1')->first();

        if($group){
            //...
            $group->status = '0';
            $group->save();

            return $this->sendResponse($group, 'Let the Magic Begin!');
        }

        return $this->sendError('Something went wrong.'); 
    }


    //...addUser
    public function addUser(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'code' => 'nullable|max:10',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = auth()->user();
        $group = Groups::where('unique_code', $request->code)->where('status', '1')->first();

        if($group){

            $checkExist = GroupUsers::where('group_id', $group->id)->where('user_id', $user->id)->first();
            if($checkExist){
                return $this->sendError('Host is Waiting.');
            }
            //...
            $gUser = new GroupUsers;
            $gUser->group_id = $group->id;
            $gUser->user_id = $user->id;
            $gUser->save();

            return $this->sendResponse($gUser, 'You added in Group');
        }

        return $this->sendError('Something went wrong.'); 
    }


    //...show
    public function show(Request $request, Groups $group): JsonResponse
    {
        if($group->status == '1'){
            return $this->sendError('Host is Waiting.');
        }

        $group->load('groupUsers', 'groupUsers.user', 'groupUsers.user.preferences');

        return $this->sendResponse($group, 'Group Details retrieved successfully.');
    }


}
