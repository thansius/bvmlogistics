<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhilProvinceController extends Controller
{
    
    public static function getProvinces(){
        $provinces = DB::table('refprovinces')
                    ->select('provDesc','provCode')
                    ->orderBy('provDesc', 'ASC')
                    ->get();
        return json_decode($provinces, true);
    }

    public function myformAjax($id)
    {
        $cities = DB::table("refcitymuns")
                    ->where("provCode",$id)
                    ->select("citymunCode","citymunDesc")->get();

        return json_encode($cities, true);

    }

    public function getBarangays($id)
    {
        $brgys = DB::table("refbrgys")
                    ->where("citymunCode",$id)
                    ->select("brgyCode","brgyDesc")->get();

        return json_encode($brgys, true);

    }
}

