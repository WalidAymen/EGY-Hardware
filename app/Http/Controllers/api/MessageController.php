<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessagesResource;
use App\Http\Resources\SettingResource;
use App\Models\Messages;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tittle'=>'nullable|string|max:50',
            'message'=>'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 406);
        }
        $message=Messages::create([
            'tittle'=>$request->tittle,
            'body'=>$request->message,
            'user_id'=>Auth::user()->id,
        ]);
        return response()->json(['msg' => 'created successfully','message'=>new MessagesResource($message)], 201);
    }
    public function all()
    {
        $messages=Messages::all();
        return MessagesResource::collection($messages);

    }
    public function contact()
    {
        $settings=Setting::first();
        return new SettingResource($settings);
    }
    public function delete($id)
    {
        $message=Messages::findOrFail($id);
        $message->delete();
        return response()->json(['msg' => 'deleted successfully'], 200);
    }
}
