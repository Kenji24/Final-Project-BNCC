<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use App\Models\Category;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AppController extends Controller
{
    public function test(Request $request){
        Log::info('Request data: ' . json_encode($request->all()));
        return response()->json(['request' => $request->all()]);
    }

    public function home(){

        $toys = Toy::take(8)->get();
        $categories = Category::all();
        return view('landing.index', compact(['toys', 'categories']));
    }

    public function menu(){

        $toys = Toy::paginate(16);
        $categories = Category::all();
        return view('landing.menu', compact(['toys', 'categories']));
    }

    public function about(){
        return view('about');
    }

    public function search(Request $request){
        $keyword = $request->input('keyword');
        $toys = Toy::where("name", "like","%$keyword%")->paginate(16);
        return view('landing.menu', compact('toys'));
    }

    public function login(){
        return view('auth.login');
    }

    public function user_login(Request $request){
        $request->validate([
            'email' => 'email|required',
            'password' => 'string|required'
        ]);

        if(Auth::attempt([
            "email" => $request -> input('email'),
            "password" => $request -> input('password')
        ], $request->input('remember'))){
            $request->session()->regenerate();

            if(Auth::user()->role == "admin"){
                return redirect()->route('admin.home');
            }

            return redirect()->route('home');
        }

        return redirect()->back()->withErrors([
            "error" => "Invalid Input!"
        ]);

    }

    public function register(){
        return view('auth.register');
    }

    public function user_register(Request $request){
        $request->validate([
            'Firstname' => 'string|required',
            'Lastname' => 'string|required',
            'email' => 'email|required',
            'password' => 'string|required',
        ]);

        $user = User::create([
            "firstName" => $request -> Firstname,
            "lastName" => $request -> Lastname,
            "email" => $request -> email,
            "password" => $request -> password,
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }

    public function user_logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function admin(){

        $toys = Toy::all();
        $categories = Category::all();
        return view('admin.index', compact(['toys', 'categories']));
    }

    public function filterAdmin(Category $category){
        if($category->id){
            $toys = Toy::where("category_id", $category->id)->get();
        }
        else{
            $toys = Toy::all();
        }
        $categories = Category::all();
        return view('admin.index', compact(['toys', 'categories']));
    }

    public function filterMenu(Category $category){
        if($category->id){
            $toys = Toy::where("category_id", $category->id)->paginate(16);
        }
        else{
            $toys = Toy::paginate(16);
        }
        $categories = Category::all();
        return view('landing.menu', compact(['toys', 'categories']));
    }

    public function addMoney(){
        return view('landing.money');
    }

    public function money(Request $request){
        $validation = Validator::make($request->all(), [
            'money' => 'required|numeric|min:0',
        ]);

        if($validation->fails()){
            return redirect()->route('user.money')->with('failed', 'Sepertinya ada yang salah?');
        }
        else{
            $user_id = Auth::user()->id;
            $user = User::find($user_id);

            $user->update([
                "money" => $user->money + $request->input('money'),
            ]);
            $user->save();


            return redirect()->route('home')->with('success', 'Saldomu berhasil ditambah!');
        }

        return true;
    }
}
