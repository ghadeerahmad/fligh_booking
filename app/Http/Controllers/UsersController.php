<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('control.users', ['users' => $users]);
    }
    public function loginPage()
    {
        return view('auth.login');
    }
    public function login()
    {
        $attr = request()->validate([
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($attr))
            return redirect('/control/users');

        return back()->withErrors(['error' => 'خطأ في اسم المستخدم أو كلمة المرور']);
    }
    public function registerPage()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:users,email|max:255',
            'password' => 'required|min:8',
            'confirm' => 'required',
            'passport' => 'required|max:10'
        ]);
        if ($request->input('password') != $request->input('confirm'))
            return back()->withErrors(['error' => 'كلمتا المرور غير متطابقتين']);
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'passport' => $request->input('passport')
        ];
        $user = User::create($data);
        if ($user != null) {
            Auth::login($user);
            return redirect('/');
        }
        return back()->withErrors(['error' => 'خطأ غير معروف']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with(['success' => 'تم الحذف']);
    }
}
