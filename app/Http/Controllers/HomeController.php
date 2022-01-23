<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Setting;

class HomeController extends Controller
{
    public static function categorylist()
    {
        return Category::where('parent_id','=', 0)->with('children')->get();
    }

    public static function getsetting(){
        return Setting::first();
    }

    public function index()
    {
        $setting=Setting::first();
        return view('home.index',['setting'=>$setting]);
    }
    
    public function aboutus()
    {
        $setting=Setting::first();
        return view('home.about',['setting'=>$setting]);
    }

    public function contact()
    {
        $setting=Setting::first();
        return view('home.contact',['setting'=>$setting]);
    }
    
    public function faq()
    {
        return view('home.faq');
    }

    public function references()
    {
        $setting=Setting::first();
        return view('home.references',['setting'=>$setting]);
    }

    public function login()
    {
        return view('admin.login');
    }

    public function logincheck(Request $request)
    {
        
        if ($request->isMethod('post')) {
            $credentails=$request->only('email','password');
            if(Auth::attempt($credentails))
            {
                $request->session()->regenerate();
                return redirect()->intended('admin');
            }
            return back()->withErrors([
                'email'=>'The provided credentials do not match our records'
            ]);
        }
        else
        {
            return view('admin.login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        return redirect('/');
    }
}