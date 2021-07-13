<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use App\Models\Governorates;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255|confirmed',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 201);
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Cart::create([
            'user_id'=>$user->id
        ]);
        $token = $user->createToken('auth-token');
        return response()->json(['msg' => 'registered successfully', 'token' => $token->plainTextToken, 'user' => new UserResource($user)], 201);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 201);
        }
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['msg' => 'wrong email or password'], 503);
        }
        $token = $user->createToken('auth-token');
        return response()->json(['msg' => 'login successfully', 'token' => $token->plainTextToken, 'user' => new UserResource($user)], 200);
    }
    public function logout(Request $request)
    {
        $user=$request->user();
        $user->tokens()->delete();
        return response(['message' => 'You have been successfully logged out.'], 200);
    }
    public function editInfo(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if ($user == null) {
            return response()->json(['msg' => '404 not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => "required|string|email|unique:Users,email,{$user->id}|max:255",
            'phone' => 'required|max:255|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        return response()->json(['msg' => 'updated successfully', 'user' => new UserResource($user)], 200);
    }
    public function changePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if ($user == null) {
            return response()->json(['msg' => '404 not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|max:255',
            'password' => 'required|max:255|string|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        $userPasswordCheck = Hash::check($request->old_password, $user->password);
        if (!$userPasswordCheck) {
            return response()->json(['msg' => 'wrong password'], 406);
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['msg' => 'password changed successfully'], 200);
    }
    public function modifyAddress(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if ($user == null) {
            return response()->json(['msg' => '404 not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        $user->update([
            'city' => $request->city,
            'address' => $request->address,
        ]);
        return response()->json(['msg' => 'updated successfully'], 200);
    }
    public function showorders()
    {
        $user = User::find(auth()->user()->id);
        $orders = $user->orders->where('status', '!=', 'request return');
        return OrderResource::collection($orders);

    }
    public function returnOrders()
    {
        $user = Auth::user();
        $orders = $user->orders->where('status', 'request return');
        return OrderResource::collection($orders);

    }
    public function all()
    {
        $users = User::all();
        return UserResource::collection($users);

    }
    public function adminAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'role' => 'required|string|max:255|in:super_admin,admin,bookkeeper,customer',
            'email' => 'required|email|unique:users,email|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 201);
        }
        $user=User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Cart::create([
            'user_id'=>$user->id
        ]);
        return response()->json(['msg' => 'added successfully', 'user' => new UserResource($user)], 201);
    }
    public function adminEdit($id, Request $request)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'role' => 'required|string|max:255|in:super_admin,admin,bookkeeper,customer',
            'email' => "required|email|unique:Users,email,{$user->id}|string|max:255"
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 201);
        }
        if ($request->password != null) {
            $user->update([
                'name' => $request->name,
                'city' => $request->city,
                'address' => $request->address,
                'phone' => $request->phone,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->json(['msg' => 'updated successfully', 'user' => new UserResource($user)], 200);
        }
        $user->update([
            'name' => $request->name,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => $request->role,
            'email' => $request->email,
        ]);
        return response()->json(['msg' => 'updated successfully', 'user' => new UserResource($user)], 200);
    }
    public function delete($id)
    {
        if ((User::where('name', 'Deleted user')->first()) == null) {
            User::create([
                'name' => 'Deleted user',
                'phone' => 'Deleted user',
                'email' => 'deleted@user.user',
                'password' => Hash::make('deleteduser'),
            ]);
        }
        $newUser = User::where('name', 'Deleted user')->first();
        $user = User::findOrFail($id);
        foreach ($user->orders as $order) {
            $order->update([
                'user_id' => $newUser->id
            ]);
        }
        if ($user->cart !=null) {
            $user->cart->delete();
        }
        $user->delete();
        return response()->json(['msg' => 'deleted successfully'], 200);
    }
}
