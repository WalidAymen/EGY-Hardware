<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Governorates;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function profile()
    {
        $user=Auth::user();
        return view('auth.profile',[
            'user'=>$user
        ]);
    }

    public function editInfoForm()
    {
        $user=Auth::user();
        return view('auth.editInfo',[
            'user'=>$user
        ]);
    }
    public function changePasswordForm()
    {
        $user=Auth::user();
        return view('auth.changePassword',[
            'user'=>$user
        ]);
    }
    public function modifyAddressForm()
    {
        $user=Auth::user();
        $govs=Governorates::all();
        return view('auth.modifAddress',[
            'user'=>$user,
            'govs'=>$govs
        ]);
    }


    public function editInfo(Request $request)
    {
        $user=User::findOrFail(Auth::user()->id);
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>"required|string|email|unique:Users,email,{$user->id}|max:255",
            'phone'=>'required|max:255|string'
        ]);
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone
        ]);
        return redirect()->back();
    }
    public function changePassword(Request $request)
    {
        $user=User::findOrFail(Auth::user()->id);
        $userPasswordCheck=Hash::check($request->old_password, $user->password);
        if(!$userPasswordCheck)
        {
            return view('auth.changePassword',[
                'user'=>$user,
                'custom_error'=>'Old password is not correct'
            ]);
        }
        $request->validate([
            'old_password'=>'required|string|max:255',
            'password'=>'required|max:255|string|confirmed'
        ]);

        $user->update([
            'password'=>Hash::make($request->password) ,
        ]);
        return redirect()->back();
    }
    public function modifyAddress(Request $request)
    {
        $user=User::findOrFail(Auth::user()->id);
        $request->validate([
            'city'=>'required|string|max:255',
            'address'=>'required|string|max:255',
        ]);
        $user->update([
            'city'=>$request->city,
            'address'=>$request->address,
        ]);
        return back();


    }
    public function showorders()
    {
        $user = Auth::user();
        $orders=$user->orders->where('status','!=','request return');
        return view('auth.showOrders',[
            'orders'=>$orders
        ]);

    }
    public function returnOrders()
    {
        $user = Auth::user();
        $orders=$user->orders->where('status','request return');
        return view('auth.showReturnOrders',[
            'orders'=>$orders
        ]);

    }
    public function all()
    {
        $users=User::all();
        return view('DashBoard.Users.allUsers',[
            'users'=>$users
        ]);
    }




    public function adminAdd(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'password'=>'required|string|max:255',
            'phone'=>'required|string|max:255',
            'role'=>'required|string|max:255|in:super_admin,admin,bookkeeper,customer',
            'email'=>'required|email|unique:users,email|string|max:255'
        ]);
        User::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'role'=>$request->role,
            'email'=>$request->email,
            'password'=>Hash::make($request->password) ,
        ]);
        return redirect()->back();
    }
    public function adminEditForm($id)
    {
        $user=User::findOrFail($id);
        $govs=Governorates::all();
        return view('DashBoard.Users.editUser',[
            'user'=>$user,
            'govs'=>$govs
        ]);
    }
    public function adminEdit($id,Request $request)
    {
        $user=User::findOrFail($id);
        $request->validate([
            'name'=>'required|string|max:255',
            'city'=>'nullable|string|max:255',
            'address'=>'nullable|string|max:255',
            'password'=>'nullable|string|max:255',
            'phone'=>'required|string|max:255',
            'role'=>'required|string|max:255|in:super_admin,admin,bookkeeper,customer',
            'email'=>"required|email|unique:Users,email,{$user->id}|string|max:255"
        ]);
        if ($request->password !=null) {
            $user->update([
                'name'=>$request->name,
                'city'=>$request->city,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'role'=>$request->role,
                'email'=>$request->email,
                'password'=>Hash::make($request->password) ,
            ]);
            return redirect()->back();
        }
        $user->update([
            'name'=>$request->name,
            'city'=>$request->city,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'role'=>$request->role,
            'email'=>$request->email,
        ]);
        return redirect()->back();



    }



    public function delete($id)
    {
        if ((User::where('name','Deleted user')->first())==null) {
            User::create([
                'name'=>'Deleted user',
                'phone'=>'Deleted user',
                'email'=>'deleted@user.user',
                'password'=>Hash::make('deleteduser') ,
            ]);
        }
        $newUser=User::where('name','Deleted user')->first();
        $user=User::findOrFail($id);
        foreach ($user->orders as $order) {
            $order->update([
                'user_id'=>$newUser->id
            ]);
        }
        $user->cart->delete();
        $user->delete();
        return redirect()->back();
    }
    public function search(Request $request)
    {
        if ($request->keyword ==null) {
            $users = User::all();
            return view('DashBoard.Users.allUsers', [
                'users' => $users,
                'keyword'=>$request->keyword
            ]);
        }
        $users = User::where('name','like',"%".$request->keyword."%")->get();
            return view('DashBoard.Users.allUsers', [
                'users' => $users,
                'keyword'=>$request->keyword
            ]);
    }



}
