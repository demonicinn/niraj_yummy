<?php

namespace App\Http\Controllers\Ab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    public $perPage;

    public function __construct() {
        $this->perPage = config('app.perPage');
    }

    //index
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::where(function ($query) use ($search) {
            $query->where('first_name', 'like', '%'.$search.'%');
            $query->orWhere('last_name', 'like', '%'.$search.'%');
        })
        ->where('role', 'user')
        ->orderBy('id', 'desc')
        ->paginate($this->perPage);

        return view('ab.users.index', compact('users'));
    }

    //edit - update
    public function edit(Request $request, User $user)
    {
        if($request->isMethod('PATCH')){
            $request->validate([
                'first_name' => 'required|string|max:150',
                'last_name' => 'required|string|max:150',
                'email' => 'required|string|max:150|unique:users,email,'.$user->id,
                'dob' => 'nullable|date',
                'image' => 'nullable|image|max:1024|mimes:'. imagesMimeText(),
                'password' => 'nullable|string|min:6',
                'password_confirmation' => 'nullable|same:password',
                'status' => 'required',
            ]);

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->dob = $request->dob;
            $user->number = $request->number;

            //...files
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                
                $filename = time().'.'.$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                $path = $file->storeAs('profile', $filename, 'public');
            
                //...
                $user->image = $filename;
            }

            if($request->password){
                $user->password = Hash::make($request->password);
            }

            //...
            $user->status = $request->status;
            $user->save();

            $request->session()->flash('success', "User updated successfully");
            return redirect()->route('ab.users');
        }

        return view('ab.users.edit', compact('user'));
    }

    //Delete
    public function delete(Request $request, User $user)
    {
		$user->delete();
		$request->session()->flash('success', 'User deleted successfully');
		return redirect()->route("ab.users");
    }


    //show
    public function show(Request $request, User $user)
    {
		$user->load('preferences');
		
        return view('ab.users.show', compact('user'));
    }


}
