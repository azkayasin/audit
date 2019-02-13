<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\kda;

class kdacontroller extends Controller
{
	public function index()
	{
		$kda = DB::table('kda')->leftjoin('unit','kda.unit','=','unit.id_unit')->get();
    	//$kda = DB::table('kda')->get();
    	//return response()->json($kda);
		return view ("kda", compact('kda'));
	}

	public function pilih()
	{

		$unit = DB::table('unit')->get();
        $unit1 = DB::table('unit')->get();
        return view("pilihkda", compact('unit','unit1'));

	}

}
