<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomAuthController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employees = Employee::orderBy('employeeID', 'desc')->get();
        return view('employees.index', compact('employees'));
    }

    public function getInactiveEmps(){
        $employees = Employee::where('status', '=', 0)->orderBy('employeeID', 'desc')->get();
        return $employees;
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employeeID' => 'required',
            'lastName' => 'required',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'position' => 'required',
            'birthday' => 'required|date|before:18 years ago',
            'department' => 'required',
            'contactNumber' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:11'
        ]);
        
        // $checker = DB::select("SELECT * FROM `employees` WHERE `lastName` = '$request->lastName' AND `firstName` = '$request->firstName' AND `middleName` = '$request->middleName' AND `birthday` = '$request->birthday' AND `department`='$request->department' AND `position` = '$request->position';");
        // $checker = Employee::where("lastName", "=", $request->lastName)
        //     ->where("firstName", "=", $request->firstName)
        //     ->where("middleName", "=", $request->middleName)
        //     ->where("birthday", "=", $request->birthday)
        //     ->where("department", "=", $request->department)
        //     ->where("position", "=", $request->position)->count();

        $checker = Employee::where([
            ["firstName", "=", $request->firstName],
            ["middleName", "=", $request->middleName],
            ["lastName", "=", $request->lastName],
            ["birthday", "=", Carbon::parse($request->birthday)->format('Y-m-d')],
            ["position", "=", $request->position],
            ["department", "=", $request->department]
        ])->count();

        if($checker == 0){
            $employee = new Employee();
            $employee->lastName = $request->lastName;
            $employee->firstName = $request->firstName;
            $employee->middleName = $request->middleName;
            $employee->position = $request->position;
            $employee->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
            $employee->department = $request->department;
            $employee->contactNumber = $request->contactNumber;
            $employee->save();
            
            $data = [$request->employeeID, strtolower(preg_replace('/\s*/', '', $request->lastName)).substr(str_replace("-","",$employee->birthday), -6) ,$employee->position];
    
            app('App\Http\Controllers\CustomAuthController')->create($data);
            return redirect()->route('employees.index')
            ->with('success','Employee has been created successfully. Default Password is Last Name + Date Of Birth(YYMMDD) (ex. santos990123)');
        }
        else{
            return redirect()->route('employees.index')
            ->with('error','Employee already exists.');
        }

        
    }


    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $employeeID)
    {
        $request->validate([
            'lastName' => 'required',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'position' => 'required',
            'birthday' => 'required|date|before:18 years ago',
            'department' => 'required',
            'contactNumber' => 'nullable'
        ]);

        $employee = Employee::find($employeeID);
        $employee->lastName = $request->lastName;
        $employee->firstName = $request->firstName;
        $employee->middleName = $request->middleName;
        $employee->position = $request->position;
        $employee->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
        $employee->department = $request->department;
        $employee->contactNumber = $request->contactNumber;
        $employee->save();
        return redirect()->route('employees.index')
        ->with('success','Employee has been updated successfully.');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'lastName' => 'required',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'position' => 'required',
            'birthday' => 'required|date|before:18 years ago',
            'department' => 'required',
            'contactNumber' => 'nullable'
        ]);

        $employee = Employee::find(Auth::user()->username);
        $employee->lastName = $request->lastName;
        $employee->firstName = $request->firstName;
        $employee->middleName = $request->middleName;
        $employee->position = $request->position;
        $employee->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
        $employee->department = $request->department;
        $employee->contactNumber = $request->contactNumber;
        $employee->save();

        return 'updated successfully!';
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'newPW' => 'required',
            'oldPW' => 'required'
        ]);

        if(Hash::check($request->oldPW,Auth::user()->password)){
            $employee = User::find(Auth::user()->id);
            $employee->password = Hash::make($request->newPW);
            $employee->save();
            return 'success';
        }else{
            return 'error';
        }

        
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'employeeID' => 'required'
        ]);

        $empDetails = Employee::where('employeeID', $request->employeeID)->first();
        $password = strtolower(preg_replace('/\s*/', '', $empDetails->lastName)).substr(str_replace("-","",$empDetails->birthday), -6);

        $employee = User::where('username',$request->employeeID)->first();
        $employee->password = Hash::make($password);
        $employee->save();
        return 'success';

        
    }

    public static function countEmployees(){
        $employeeCount = Employee::count();
        return $employeeCount;
    }

    public static function getNextID(){
        $statement = DB::select("SHOW TABLE STATUS LIKE 'employees'");
        $nextId = $statement[0]->Auto_increment;
        return $nextId;
    }

    public static function getCarriers(){
        $employees = Employee::where('position', '=', 'Carrier')->orderBy('employeeID', 'desc')->get();
        return $employees;
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        app('App\Http\Controllers\CustomAuthController')->destroy($id);

        $employee = Employee::find($id);
        $employee->status = 0;
        $employee->save();
        return redirect()->route('employees.index')
        ->with('success','Employee has been deactivated successfully.');

        // DB::table('employees')->where('employeeID', $id)->delete();
        // return redirect()->route('employees.index')
        // ->with('success','Employee has been deleted successfully.');
    }

    public function reactivate(Request $request)
    {
        
        $id = $request->empid;
        app('App\Http\Controllers\CustomAuthController')->reactivate($id);
        $employee = Employee::find($id);
        $employee->status = 1;
        $employee->save();
        return 'success';
    }
}
