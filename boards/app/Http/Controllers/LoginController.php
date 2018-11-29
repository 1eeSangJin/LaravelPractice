<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    //

    public function __construct(){
        return $this->middleware('guest', ['except'=>'destroy']);
    }

    public function destroy(){
        auth()->logout();
        return redirect('bbs')->with('message', '또 방문해주세요');
    }

    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $email = $request->email;
        $user = User::whereEmail($email)->first();

        if($user->activated == 0){
            return back()->withInput()->with('message', '이메일 인증을 하십시오');
        }

        if(!auth()->attempt($request->only('email', 'password'), $request->has('remember'))){
            // flash('이메일 또는 비밀번호가 맞지 않습니다');
            return back()->withInput();
        }

        return view('main');
    }
}
