<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use DB;
use App\kda;
use App\customer;
use App\temuan;

class cobacontroller extends Controller
{
	public function bulan()
	{
		// $tanggal = kda::select('tanggal')->where('id_kda', 1)->get();
		// print($tanggal);
    	// $m=date('m',$tanggal);
    	// print($m);
    	//list($year, $month, $day) = explode('-', $tanggal);
    	//print($month);
		// $month = 02;
    	// $bulan = DB::table('kda')->whereMonth($month);
    	// print($bulan);
    	// $bulan2 = DB::table('kda')->where(DB::raw(MONTH('tanggal')), $month);
    	// 	print($bulan2);
		$currentMonth = date('m');
		$data = kda::select('id_kda')
		->where('unit',2)
		->whereRaw('MONTH(tanggal) != ?',[$currentMonth])
		->get();
		//print($data);

		//$temuan = DB::table('temuan')->whereIn('kda_id', $data)->get();
		$temuan = DB::table('temuan')->get();
		//print($temuan);
		return view ("temuan", compact("temuan"));

	}
	public function getkda(Request $request)
	{
		$id = $request->input('id');
		$kda = kda::find($id);
        //$kda = DB::table('kda')->whereIn('id_kda', $id)->get();
        //return ($kda);
		return response()->json($kda);
	}
	public function updatekda(Request $request)
	{

		$data = $request->all();
		$kda = kda::find($request->id);
		//return ($data);
		$kda->update($data, ['except'=>'_token']);
		return redirect('/kda');

	}
	public function gettemuan(Request $request)
	{
		$id = $request->input('id');
		$temuan = DB::table('temuan')->where('kda_id',$id)->get();
        //$kda = DB::table('kda')->whereIn('id_kda', $id)->get();
        //return ($kda);
		return response()->json($temuan);
	}
	public function updatetemuan(Request $request)
	{

		$data = $request->all();
		$jumlah = count($data);
		$data = $request->checkbox;
		//dd ($data);
		//dd ($jumlah);

		//return($data);
		//$temuan = temuan::find([$data]);
		//$temuan = DB::table('temuan')->whereIn('id', $data)->get();
		//dd ($temuan);
		temuan::whereIn('id', $data)
		->update([
			'status' => '1'
    	]);
		// for ($i=0; $i < $jumlah; $i++) { 
			//$temuan = temuan::find([$data]);


			// $temuan->update($data, ['except'=>'name','keterangan']);
		
		return redirect('/temuan');

	}
	
	public function coba($id)
	{
		$kda = kda::find($id);
		return ($kda);
	}




}
