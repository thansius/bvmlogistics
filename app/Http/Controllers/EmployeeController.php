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
        ->with('success','Employee has been created successfully.');
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

        DB::table('employees')->where('employeeID', $id)->delete();
        return redirect()->route('employees.index')
        ->with('success','Employee has been deleted successfully.');
    }
}
