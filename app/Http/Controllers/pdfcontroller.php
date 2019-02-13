<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temuan;
use App\kda;
use PDF;
use DB;

class pdfcontroller extends Controller
{
	public function buatpdf($id)
	{
		$temuan = DB::table('temuan')->where('kda_id',$id)->get();
		$kda = DB::table('kda')->where('id_kda',$id)->leftjoin('unit','kda.unit','=','unit.id_unit')->get();
		//$kda = json_encode($kda);
		//$kda = DB::table('kda')->where('id_kda','$id') ->leftjoin('unit','kda.unit','=','unit.id_unit')->get();
		//return response()->json($kda);
		//return ($temuan);
		$pdf = PDF::loadView('pdf', ['kda' => $kda, 'temuan' => $temuan]);
		return $pdf->download('invoice.pdf');

	}
}
