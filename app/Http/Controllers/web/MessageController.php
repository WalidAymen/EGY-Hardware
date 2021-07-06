<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'tittle'=>'nullable|string|max:50',
            'message'=>'required|string|max:255'
        ]);
        Messages::create([
            'tittle'=>$request->tittle,
            'body'=>$request->message,
            'user_id'=>Auth::user()->id,
        ]);
        return redirect()->back();
    }
    public function all()
    {
        $messages=Messages::orderBy('id','desc')->get();
        return view('DashBoard.allMessages',['messages'=>$messages]);

    }
    public function contact()
    {
        $settings=Setting::first();
        return view('contactUs',['settings'=>$settings]);
    }
    public function delete($id)
    {
        $message=Messages::findOrFail($id);
        $message->delete();
        return redirect()->back();
    }
}
