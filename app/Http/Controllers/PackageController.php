<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['getPackageProgress']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['packages'] = DB::select("SELECT packageID, trackingNumber, length, width, height, weight, 
        employees.firstName, employees.lastName, 
        s.firstName as 'senderF', s.lastName as 'senderL', 
        r.firstName as 'recF', r.lastName as 'recL', 
        r.contactNumber, r.floor_unit, r.streetAddress, 
        refbrgys.brgyDesc as 'barangay', refcitymuns.citymunDesc as 'city_municipality', refprovinces.provDesc as 'province', r.zipCode, 
        packages.status FROM packages 
        JOIN employees ON packages.carrierID = employees.employeeID 
        JOIN customers AS s ON packages.senderID = s.id 
        JOIN customers AS r ON packages.receiverID = r.id
        JOIN refprovinces ON r.province = refprovinces.provCode
        JOIN refcitymuns ON r.city_municipality = refcitymuns.citymunCode
        JOIN refbrgys ON r.barangay = refbrgys.brgyCode ORDER BY packageID desc;");
        return view('packages.index', $data);
    }

    public function getInWH()
    {
        $data['packages'] = DB::select("SELECT packageID, trackingNumber, length, width, height, weight,
        employees.firstName, employees.lastName, 
        s.firstName as 'senderF', s.lastName as 'senderL', 
        r.firstName as 'recF', r.lastName as 'recL', 
        r.contactNumber, r.floor_unit, r.streetAddress, 
        refbrgys.brgyDesc as 'barangay', refcitymuns.citymunDesc as 'city_municipality', refprovinces.provDesc as 'province', r.zipCode, 
        packages.status FROM packages 
        JOIN employees ON packages.carrierID = employees.employeeID 
        JOIN customers AS s ON packages.senderID = s.id 
        JOIN customers AS r ON packages.receiverID = r.id
        JOIN refprovinces ON r.province = refprovinces.provCode
        JOIN refcitymuns ON r.city_municipality = refcitymuns.citymunCode
        JOIN refbrgys ON r.barangay = refbrgys.brgyCode 
        WHERE packages.status = 1 ORDER BY packageID desc;");
        return view('packages.inwarehouse', $data);
    }
    public function getInTransit()
    {
        $data['packages'] = DB::select("SELECT packageID, trackingNumber, length, width, height, weight,
        employees.firstName, employees.lastName, 
        s.firstName as 'senderF', s.lastName as 'senderL', 
        r.firstName as 'recF', r.lastName as 'recL', 
        r.contactNumber, r.floor_unit, r.streetAddress, 
        refbrgys.brgyDesc as 'barangay', refcitymuns.citymunDesc as 'city_municipality', refprovinces.provDesc as 'province', r.zipCode, 
        packages.status FROM packages 
        JOIN employees ON packages.carrierID = employees.employeeID 
        JOIN customers AS s ON packages.senderID = s.id 
        JOIN customers AS r ON packages.receiverID = r.id
        JOIN refprovinces ON r.province = refprovinces.provCode
        JOIN refcitymuns ON r.city_municipality = refcitymuns.citymunCode
        JOIN refbrgys ON r.barangay = refbrgys.brgyCode 
        WHERE packages.status = 2 ORDER BY packageID desc;");
        return view('packages.intransit', $data);
    }
    public function getDelivered()
    {
        $data['packages'] = DB::select("SELECT packageID, trackingNumber, length, width, height, weight,
        employees.firstName, employees.lastName, 
        s.firstName as 'senderF', s.lastName as 'senderL', 
        r.firstName as 'recF', r.lastName as 'recL', 
        r.contactNumber, r.floor_unit, r.streetAddress, 
        refbrgys.brgyDesc as 'barangay', refcitymuns.citymunDesc as 'city_municipality', refprovinces.provDesc as 'province', r.zipCode, 
        packages.status FROM packages 
        JOIN employees ON packages.carrierID = employees.employeeID 
        JOIN customers AS s ON packages.senderID = s.id 
        JOIN customers AS r ON packages.receiverID = r.id
        JOIN refprovinces ON r.province = refprovinces.provCode
        JOIN refcitymuns ON r.city_municipality = refcitymuns.citymunCode
        JOIN refbrgys ON r.barangay = refbrgys.brgyCode 
        WHERE packages.status = 3 ORDER BY packageID desc;");
        return view('packages.delivered', $data);
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'packageID' => 'required',
            'trackingNumber' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'senderID' => 'required',
            'receiverID' => 'required',
            'carrierID' => 'required',
        ]);

        $package = new Package();
        $package->packageID = $request->packageID;
        $package->trackingNumber = $request->trackingNumber;
        $package->length = $request->length;
        $package->width = $request->width;
        $package->height = $request->height;
        $package->weight = $request->weight;
        $package->senderID = $request->senderID;
        $package->receiverID = $request->receiverID;
        $package->carrierID = $request->carrierID;
        $package->status = 1;
        $package->save();

        DB::table('package_trackings')->insert(
            ['trackingNumber' => $package->trackingNumber, 'description' => 'Package arrived at warehouse', 'employeeID' => Auth::user()->username, 
            "created_at" =>  \Carbon\Carbon::now('GMT+8'), 
                "updated_at" => \Carbon\Carbon::now('GMT+8'),]  
        );

        return redirect()->route('packages.index')
            ->with('success', 'Package has been created successfully.');
    }

    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, $packageID)
    {
        $request->validate([
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'senderID' => 'required',
            'receiverID' => 'required',
            'carrierID' => 'required',
        ]);

        $package = Package::find($packageID);
        $package->length = $request->length;
        $package->width = $request->width;
        $package->height = $request->height;
        $package->weight = $request->weight;
        $package->senderID = $request->senderID;
        $package->receiverID = $request->receiverID;
        $package->carrierID = $request->carrierID;
        $package->save();
        return redirect()->route('packages.index')
            ->with('success', 'Package has been updated successfully.');
    }

    public function view_package(Package $package){
        return view('packages.view_package', compact('package'));
    }

    public static function countWarehousePackages(){
        $packageCount = Package::where('status', '=', '1')->count();
        return $packageCount;
    }
    public static function countAllPackages(){
        $packageCount = Package::where('status', '!=', '0')->count();
        return $packageCount;
    }

    public static function countTransitPackages(){
        $packageCount = Package::where('status', '=', '2')->count();
        return $packageCount;
    }

    public static function countDeliveredPackages(){
        $packageCount = Package::where('status', '=', '3')->count();
        return $packageCount;
    }

    public static function countDeliveryFailedPackages(){
        $packageCount = Package::where('status', '=', '4')->count();
        return $packageCount;
    }

    public static function countToDeliver(){
        $packageCount = Package::orWhere(function ($query)  {
                            $query->where('status', '!=', '0')
                                  ->where('status', '!=', '3')
                                  ->where('status', '!=', '4');}) 
                        ->where('carrierID', '=',Auth::user()->username)  
                        ->count();
        return $packageCount;
    }
    public static function countDelivered(){
        $packageCount = Package::where('status', '=', '3')
                        ->where('carrierID', Auth::user()->username)        
                        ->count();
        return $packageCount;
    }

    public static function getNextID(){
        $statementRaw = DB::raw("SET information_schema_stats_expiry = 0;");
        $statementRaw;
        $statement = DB::select("SHOW TABLE STATUS LIKE 'packages'");
        $nextId = $statement[0]->Auto_increment;
        return $nextId;
    }

    public static function getNextTrackingNumber(){
        do{
            $trackingNumber = Str::upper(Str::random(8));
            if (Package::where('trackingNumber', '=', $trackingNumber)->count() <= 0) {
                break;
            }
        }
        while(true);
        return $trackingNumber;
    }

    public static function getPackage($packageID){
        $data = DB::select("SELECT packageID, trackingNumber, length, width, height, weight, 
        employees.firstName, employees.lastName, employees.contactNumber as 'eCNum',
        s.firstName as 'senderF', s.lastName as 'senderL', s.contactNumber as 'senderCN',
        r.firstName as 'recF', r.lastName as 'recL', 
        r.contactNumber, r.floor_unit, r.streetAddress, 
        refbrgys.brgyDesc as 'barangay', refcitymuns.citymunDesc as 'city_municipality', refprovinces.provDesc as 'province', r.zipCode, 
        packages.status FROM packages 
        JOIN employees ON packages.carrierID = employees.employeeID 
        JOIN customers AS s ON packages.senderID = s.id 
        JOIN customers AS r ON packages.receiverID = r.id
        JOIN refprovinces ON r.province = refprovinces.provCode
        JOIN refcitymuns ON r.city_municipality = refcitymuns.citymunCode
        JOIN refbrgys ON r.barangay = refbrgys.brgyCode 
        WHERE packageID = $packageID;");
        return $data;
    }

    public static function updatePackageStatus(Request $request){
        
        $request->validate([
            'trackingNumber' => 'required',
            'stat' =>'required',
            'description' => 'required'
        ]);
        $trackingNumber = $request->trackingNumber;
        $stat = $request->stat;
        $statDesc = $request->description;
        $numAttempts = $request->numAttempts;
        $employee = Auth::user()->username;

        if($stat === 'Delivered'){
            DB::table('packages')
                ->where('trackingNumber',$trackingNumber)
                ->update(['status' => 3]);
        }elseif($stat === 'Cancelled'){
            DB::table('packages')
                ->where('trackingNumber',$trackingNumber)
                ->update(['status' => 0]);
        }elseif($stat === 'In-Transit'){
            DB::table('packages')
                ->where('trackingNumber',$trackingNumber)
                ->update(['status' => 2]);
        }elseif($stat === 'Delivery Failed'){
            $statDesc .= ' Delivery Attempts: ' . $numAttempts;
            DB::table('packages')
                ->where('trackingNumber',$trackingNumber)
                ->update(['status' => 4]);
        }
        
        DB::table('package_trackings')->insert(
            ['trackingNumber' => $trackingNumber, 'description' => $statDesc, 'employeeID' => $employee, 
            "created_at" =>  \Carbon\Carbon::now('GMT+8'), 
                "updated_at" => \Carbon\Carbon::now('GMT+8'),]  
        );
        
        return 'update successful';
    }

    public static function updateCarrier(Request $request){
        $request->validate([
            'packageID' => 'required',
            'carrierID' => 'required'
        ]);

        $packageID = $request->packageID;
        $carrierID = $request->carrierID;

        DB::table('packages')
                ->where('packageID',$packageID)
                ->update(['carrierID' => $carrierID]);

        return 'update successful';
    }

    public static function getPackageProgress($trackingNumber){
        $data = DB::select("SELECT * FROM `package_trackings` WHERE `trackingNumber` = '$trackingNumber' ORDER BY `created_at` DESC;");
        return $data;
    }

    public static function getPackageProgressEdit($trackingNumber){
        $data = DB::select("SELECT *, pt.created_at as `pdate` FROM `package_trackings` as `pt` JOIN `employees` as `em` ON pt.employeeID = em.employeeID WHERE `trackingNumber` = '$trackingNumber' ORDER BY pt.created_at DESC;");
        return $data;
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index')
            ->with('success', 'Package has been deleted successfully.');
    }

    public static function getToDeliver(){
        $id = Auth::user()->username;
        $data = DB::select("SELECT packageID, trackingNumber, length, width, height, weight, 
        employees.firstName, employees.lastName, 
        s.firstName as 'senderF', s.lastName as 'senderL', 
        r.firstName as 'recF', r.lastName as 'recL', 
        r.contactNumber, r.floor_unit, r.streetAddress, 
        refbrgys.brgyDesc as 'barangay', refcitymuns.citymunDesc as 'city_municipality', refprovinces.provDesc as 'province', r.zipCode, 
        packages.status FROM packages 
        JOIN employees ON packages.carrierID = employees.employeeID 
        JOIN customers AS s ON packages.senderID = s.id 
        JOIN customers AS r ON packages.receiverID = r.id
        JOIN refprovinces ON r.province = refprovinces.provCode
        JOIN refcitymuns ON r.city_municipality = refcitymuns.citymunCode
        JOIN refbrgys ON r.barangay = refbrgys.brgyCode 
        WHERE carrierID = $id AND (packages.status = 1 OR packages.status = 2) ORDER BY packageID desc;");
        return $data;
    }

    public static function getDeliveredCarrier(){
        $id = Auth::user()->username;
        $data = DB::select("SELECT packageID, trackingNumber, length, width, height, weight, 
        employees.firstName, employees.lastName, 
        s.firstName as 'senderF', s.lastName as 'senderL', 
        r.firstName as 'recF', r.lastName as 'recL', 
        r.contactNumber, r.floor_unit, r.streetAddress, 
        refbrgys.brgyDesc as 'barangay', refcitymuns.citymunDesc as 'city_municipality', refprovinces.provDesc as 'province', r.zipCode, 
        packages.status FROM packages 
        JOIN employees ON packages.carrierID = employees.employeeID 
        JOIN customers AS s ON packages.senderID = s.id 
        JOIN customers AS r ON packages.receiverID = r.id
        JOIN refprovinces ON r.province = refprovinces.provCode
        JOIN refcitymuns ON r.city_municipality = refcitymuns.citymunCode
        JOIN refbrgys ON r.barangay = refbrgys.brgyCode 
        WHERE carrierID = $id AND packages.status = 3 ORDER BY packageID desc;");
        return $data;
    }
}
