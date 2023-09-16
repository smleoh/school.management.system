<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function UserView() {
        // $allData  = User::all();
        $data['allData'] = User::all();
        return view('backend.user.view_user',$data);
    } // End Method

    public function UserAdd() {
       return view('backend.user.add_user');
    } // End Method

    public function UserStore(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required'
        ]);

        $data = new User();
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $notification = array(
          'message' => 'User Inserted Successfully',
          'alert-type' => 'success',
        );
        return redirect()->route('user.view')->with($notification);
    }

    public function UserEdit($id) {
        $editData = User::find($id);
        return view('backend.user.edit_user',compact('editData'));
    }

    public function UserUpdate(Request $request, $id) {
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();

        $notification = array(
          'message' => 'User Updated Successfully',
          'alert-type' => 'info',
        );
        return redirect()->route('user.view')->with($notification);
    }

    public function UserDelete($id) {
        $user = User::find($id);
        $user->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'info',
          );
          return redirect()->route('user.view')->with($notification);
    }
}
