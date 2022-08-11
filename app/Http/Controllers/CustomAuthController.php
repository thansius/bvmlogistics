<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) { 
            $employee = Employee::get();
            
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return back()->with('error','Login credentials are not valid');
    }

    public static  function getName(){
        $userData = DB::table('users')
                    ->join('employees', 'users.username', '=', 'employees.employeeID')
                    ->select('employees.firstName', 'employees.lastName', 'employees.position')
                    ->where('username', auth()->user()->username)->first();
        // echo "<script>console.log('Debug Objects: " . $userData . "' );</script>";
        return json_decode(json_encode($userData), true);
    }

    public static function getUser(){
        $data = DB::table('users')
                    ->join('employees', 'users.username', '=','employees.employeeID')
                    ->select('employees.*', 'users.*')
                    ->where('username', Auth::user()->username)->first();
        return json_decode(json_encode($data), true);
    }

    // public function registration()
    // {
    //     return view('auth.registration');
    // }
      
    // public function customRegistration(Request $request)
    // {  
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);
           
    //     $data = $request->all();
    //     $check = $this->create($data);
         
    //     return redirect("dashboard")->withSuccess('You have signed-in');
    // }

    public function create(array $data)
    {
      return User::create([
        'username' => $data[0],
        'password' => Hash::make($data[1]),
        'role' => $data[2]
      ]);
    }    
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('/home');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function destroy($userid)
    {
        DB::table('users')->where('username', $userid)->delete();
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}