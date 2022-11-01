<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
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
        $data['customers'] = DB::table('customers')
                ->join('refprovinces', 'customers.province', '=', 'refprovinces.provCode')
                ->join('refcitymuns', 'customers.city_municipality','=','refcitymuns.citymunCode')
                ->join('refbrgys','customers.barangay','=','refbrgys.brgyCode')
                ->select('customers.*','refprovinces.provDesc','refcitymuns.citymunDesc','refbrgys.brgyDesc')
                ->where('status', 1)->get();
        return view('customers.index', $data);
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lastName' => 'required',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'contactNumber' => 'required',
            'floor_unit' => 'required',
            'streetAddress' => 'required',
            'province' => 'required',
            'city_municipality' => 'required',
            'barangay' => 'required',
            'zipCode' => 'nullable',
        ]);


        $checker = Customer::where([
            ["firstName", "=", $request->firstName],
            ["middleName", "=", $request->middleName],
            ["lastName", "=", $request->lastName],
            ["contactNumber", "=", $request->contactNumber],
            ["floor_unit", "=", $request->floor_unit],
            ["streetAddress", "=", $request->streetAddress],
            ["province", "=", $request->province],
            ["barangay", "=", $request->barangay]
        ])->count();

        if($checker == 0){

            $customer = new Customer();
            $customer->lastName = $request->lastName;
            $customer->firstName = $request->firstName;
            $customer->middleName = $request->middleName;
            $customer->contactNumber = $request->contactNumber;
            $customer->floor_unit = $request->floor_unit;
            $customer->streetAddress = $request->streetAddress;
            $customer->province = $request->province;
            $customer->city_municipality = $request->city_municipality;
            $customer->barangay = $request->barangay;
            $customer->zipCode = $request->zipCode;
            $customer->status = 1;

            $customer->save();

            return redirect()->route('customers.index')
            ->with('success','Customer has been added successfully.');
        }else{
            return redirect()->route('customers.index')
            ->with('error','Customer already exists.');
        }
        // return response()->json(['success'=>'Successfully']);
    }

    public function storeViaPackage(Request $request){
        $request->validate([
            'lastName' => 'required',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'contactNumber' => 'required',
            'floor_unit' => 'required',
            'streetAddress' => 'required',
            'province' => 'required',
            'city_municipality' => 'required',
            'barangay' => 'required',
            'zipCode' => 'nullable',
        ]);

        $checker = Customer::where([
            ["firstName", "=", $request->firstName],
            ["middleName", "=", $request->middleName],
            ["lastName", "=", $request->lastName],
            ["contactNumber", "=", $request->contactNumber],
            ["floor_unit", "=", $request->floor_unit],
            ["streetAddress", "=", $request->streetAddress],
            ["province", "=", $request->province],
            ["barangay", "=", $request->barangay]
        ])->count();

        if($checker == 0){
            $customer = new Customer();
            $customer->lastName = $request->lastName;
            $customer->firstName = $request->firstName;
            $customer->middleName = $request->middleName;
            $customer->contactNumber = $request->contactNumber;
            $customer->floor_unit = $request->floor_unit;
            $customer->streetAddress = $request->streetAddress;
            $customer->province = $request->province;
            $customer->city_municipality = $request->city_municipality;
            $customer->barangay = $request->barangay;
            $customer->zipCode = $request->zipCode;
            $customer->status = 1;

            $customer->save();

            $id = $customer->id;

            $province = $this->getProvince($request->province);
            $city = $this->getCity($request->city_municipality);
            $barangay = $this->getBarangay($request->barangay);

            // print_r(array_column($province, 'provDesc')[0]);

            $details = $request->firstName.' '.$request->lastName.' '.
                        $request->contactNumber.' '.$request->floor_unit.', '.
                        $request->streetAddress.', '.array_column($barangay, 'brgyDesc')[0].', '.
                        array_column($city, 'citymunDesc')[0].', '.array_column($province, 'provDesc')[0];

            $custdata[0] = $id;
            $custdata[1] = $details;
            return $custdata;
        }else{
            return 'error';
        }
        
    }

    public function show(Customer $package)
    {
        return view('customers.show', compact('customer'));
    }

    public function getID(){
        $statement = DB::select("SHOW TABLE STATUS LIKE 'customers'");
        return $statement[0];
    }

    public function getProvince($provID){
        $data = DB::table('refprovinces')
                ->where('provCode',$provID)
                ->select('provDesc')
                ->get();
        return json_decode($data, true);
    }

    public function getCity($cityID){
        $data = DB::table('refcitymuns')
            ->where('citymunCode',$cityID)
            ->select('citymunDesc')
            ->get();
            return json_decode($data, true);
    }

    public function getBarangay($brgyID){
        $data = DB::table('refbrgys')
            ->where('brgyCode',$brgyID)
            ->select('brgyDesc')->get();
            return json_decode($data, true);
    }

    public static function getCustomers(){
        $data = DB::table('customers')
                ->join('refprovinces', 'customers.province', '=', 'refprovinces.provCode')
                ->join('refcitymuns', 'customers.city_municipality','=','refcitymuns.citymunCode')
                ->join('refbrgys','customers.barangay','=','refbrgys.brgyCode')
                ->select('customers.*','refprovinces.provDesc','refcitymuns.citymunDesc','refbrgys.brgyDesc')
                ->where('status', 1)
                ->orderBy('id', 'asc')->get();
        return $data;
    }

    public static function getCustomerCount(){
        $customerCount = Customer::count();
        return $customerCount;
    }

    public function edit(Customer $customer)
    {   
        $data['customer'] = DB::select("SELECT r.firstName as 'recF', r.lastName as 'recL', 
            r.contactNumber, r.floor_unit, r.streetAddress, 
            refbrgys.brgyDesc as 'barangay', refcitymuns.citymunDesc as 'city_municipality', refprovinces.provDesc as 'province', r.zipCode
            FROM customers AS r 
            JOIN refprovinces ON r.province = refprovinces.provCode
            JOIN refcitymuns ON r.city_municipality = refcitymuns.citymunCode
            JOIN refbrgys ON r.barangay = refbrgys.brgyCode 
            WHERE r.id = $customer->id ;");
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $customerID)
    {
        $request->validate([
            'lastName' => 'required',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'contactNumber' => 'required',
            'floor_unit' => 'required',
            'streetAddress' => 'required',
            'province' => 'required',
            'city_municipality' => 'required',
            'barangay' => 'required',
            'zipCode' => 'nullable',
        ]);

        $customer = Customer::find($customerID);
        $customer->lastName = $request->lastName;
        $customer->firstName = $request->firstName;
        $customer->middleName = $request->middleName;
        $customer->contactNumber = $request->contactNumber;
        $customer->floor_unit = $request->floor_unit;
        $customer->streetAddress = $request->streetAddress;
        $customer->province = $request->province;
        $customer->city_municipality = $request->city_municipality;
        $customer->barangay = $request->barangay;
        $customer->zipCode = $request->zipCode;
        $customer->status = 1;
        $customer->save();
        return redirect()->route('customers.index')
            ->with('success', 'Customer has been updated successfully.');
    }

    public static function countPackages(){
        $packageCount = Customer::where('status', 1)->count();
        return $packageCount;
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        DB::table('customers')
        ->where('id', $id)  // find your user by their email
        ->update(array('status' => 0));
        return redirect()->route('customers.index')
            ->with('success', 'Customer has been deleted successfully.');
    }
}
