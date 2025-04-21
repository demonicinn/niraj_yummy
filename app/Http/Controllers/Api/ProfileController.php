<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;

class ProfileController extends BaseController
{
    //...profile
    public function profile(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'dob' => 'nullable|date',
            'number' => 'nullable|string|max:12',
            'image' => 'nullable|image|max:1024',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();

        //...files
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            
            $filename = time().'.'.$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $path = $file->storeAs('profile', $filename, 'public');
        
            //...
            $input['image'] = $filename;
        }

        $user = User::where('id', auth()->user()->id)->update($input);
        
    
        return $this->sendResponse($user, 'Profile updated successfully.');
    }

    //...password
    public function password(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6',
            'new-password_confirmed' => 'required|same:new-password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = auth()->user();

        if (!(Hash::check($request->get('current-password'), $user->password))) {
            // The passwords matches
			return $this->sendError('Error.', "Your current password does not matches with the password you provided. Please try again.");  
        }
        
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
			return $this->sendError('Error.', "New Password cannot be same as your current password. Please choose a different password.");  
        }

        //Change Password
        $user->password = Hash::make($request->get('new-password'));
        $user->save();
    
        return $this->sendResponse($user, 'Profile updated successfully.');
    }


}
