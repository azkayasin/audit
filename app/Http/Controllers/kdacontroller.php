<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\kda;
//require 'vendor/autoload.php';

use Carbon\Carbon;

class kdacontroller extends Controller
{
	public function index()
	{
		$kda = DB::table('kda')->leftjoin('unit','kda.unit','=','unit.id_unit')->orderBy('kda.tanggal')->get();
		//dd($kda);
		$unit = DB::table('unit')->get();
    	//$kda = DB::table('kda')->get();
    	//return response()->json($kda);
		return view ("kda3", compact('kda','unit'));
	}
	public function triwulan()
	{
		//$kda = DB::table('kda')->leftjoin('unit','kda.unit','=','unit.id_unit')->get();
    	//$kda = DB::table('kda')->get();
    	//return response()->json($kda);
		$now = Carbon::now();
		$tahun = $now->year;
		$bulan = 12;
		// echo $now->month;
		// echo $now->weekOfYear;
		// echo $now->day;


		//printf("Now: %s", Carbon::now());
		return view ("triwulan", compact('tahun','bulan'));
	}

	public function pilih()
	{

		$unit = DB::table('unit')->get();
        return view("pilihkda4", compact('unit'));

	}

}
