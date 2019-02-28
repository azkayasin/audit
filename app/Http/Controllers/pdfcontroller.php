<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temuan;
use App\kda;
use PDF;
use DB;
use Zipper;

class pdfcontroller extends Controller
{
	// public function buatpdf($id)
	// {
	// 	$temuan = DB::table('temuan')->where('kda_id',$id)->get();
	// 	$kda = DB::table('kda')->where('id_kda',$id)->leftjoin('unit','kda.unit','=','unit.id_unit')->get();
	// 	//$kda = json_encode($kda);
	// 	//$kda = DB::table('kda')->where('id_kda','$id') ->leftjoin('unit','kda.unit','=','unit.id_unit')->get();
	// 	//return response()->json($kda);
	// 	//return ($temuan);
	// 	$pdf = PDF::loadView('pdf', ['kda' => $kda, 'temuan' => $temuan]);
	// 	return $pdf->download('invoice.pdf');

	// }
// 	public function buatpdf2()
// 	{
// 		$summernotes = DB::table('temuan')->get()->toArray();
// 		print_r($summernotes);
// 		echo "<br><br><br>";
// 		$temuan = DB::table('temuan')->get();
// 		print_r($temuan);
		
// // // Dump array with object-arrays
// // 		dd($arrays);
// 		//$kda = json_encode($kda);
// 		//$kda = DB::table('kda')->where('id_kda','$id') ->leftjoin('unit','kda.unit','=','unit.id_unit')->get();
// 		//return response()->json($kda);
// 		//return ($temuan);

// 		$arr = array(1, 2, 3, 4);
// 		echo "<br><br><br>";
// 		foreach($arr as $value)
// 		{
// 			echo $value;
// 		}
// 		print_r($arr);
// 		echo "<br><br><br>";
// 		foreach ($arr as $key => $value) {
// 			echo "{$key} => {$value} ";
// 		}
// 		print_r($arr);
// 		// $dompdf = PDF::loadView('pdf2', ['summernotes' => $summernotes]);
// 		// $dompdf->render();

// 		// return $dompdf->stream("hello.pdf");
// 		//return $pdf->download('cobasummer.pdf');

// 	}
	public function buatpdf3(){
		$html = '';
		$i =1;
		$summernotes = DB::table('summernotes')->get();
		foreach($summernotes as $summernotes)
		{
			$view = view('pdf2', ['summernotes' => $summernotes]);
			$html = $view->render();
			$pdf = PDF::loadHTML($html);            
			$sheet = $pdf->setPaper('a4', 'potrait');
			$filename = "kda/".$i."coba.pdf";
			//printf($filename);
			$sheet->save($filename);
			// $content = $sheet->output();
			// file_put_contents('filename.pdf', $content);
		    //return $sheet->download($i.'coba.pdf'); 
			$i++;
		}

		//return $sheet->download($i.'coba.pdf'); 
	}
	// public function buatpdf4()
	// {
	// 	$lang_array = array("chi","eng");
	// 	$i = 0;
	// 	foreach($lang_array as $lang)
	// 	{
	// 		$html = "<!DOCTYPE html><html><body>M</body></html>";
	// 		$dompdf = new PDF();
	// 		$dompdf = PDF::loadHTML($html);            
	// 	  //$dompdf->load_html($html);
	// 	  //$dompdf->set_paper("A4", 'portrait');
	// 		$dompdf = PDF::render();
	// 		$output = $dompdf->output();
	// 		unset($dompdf);
	// 		file_put_contents($i.".pdf", $output);
	// 		$i++;
	// 	}
	// }

	public function filepdf($id)
    {
        //$temuan = DB::table('temuan')->where('kda_id',$id)->get();
        $kda = DB::table('kda')->where('id_kda',$id)->leftjoin('unit','kda.unit','=','unit.id_unit')->first();
        //$kda = json_encode($kda);
        //$kda = DB::table('kda')->where('id_kda','$id') ->leftjoin('unit','kda.unit','=','unit.id_unit')->get();
        //return response()->json($kda);
        //return ($temuan);
        $nama = $kda->nama."-".$kda->tanggal;
        //return response()->json($nama);
        $pdf = PDF::loadView('pdf', ['kda' => $kda, 'temuan' => $temuan]);
        return $pdf->download($nama.'.pdf');
    }

	public function downloadkda(){
		$files = glob('kda/*');
		Zipper::make('zip/test.zip')->add($files)->close();

		if(file_exists('zip/test.zip')){
		  return response()->download('zip/test.zip');
		}else{
		  dd('File does not exists.');
		}

		//return response()->download('zip/test.zip')->deleteFileAfterSend(true);

	}
	public function laporan()
	{
		$currentMonth = date('m');
		//$periode = 2;
		$periode = array(1,2,3);
		$currentYear = date('y');
		print $currentMonth;
		echo "<br><br><br>";
		print $currentYear;
		echo "<br><br><br>";
		$query = DB::table('kda')->where('id_kda', 2)->first();
		print_r($query);

		echo "<br><br><br>";
		$data = kda::select('id_kda')
		//->whereRaw('MONTH(tanggal) = ?', $currentMonth )
		//->whereRaw("( MONTH(tanggal) = ?, 2 OR MONTH(tanggal) = ?, 3)")
		->whereRaw("MONTH(tanggal) = {$currentMonth} OR MONTH(tanggal) = 3 OR MONTH(tanggal) = 4")
		->get();
		print $data;
	}
	public function laporan2()
	{
		$sesi = 1;
		$currentYear = date('y');
		echo "<br><br><br>";
		print $currentYear;
		//$periode = 2;
		$data = kda::select('id_kda')
		//->whereRaw('MONTH(tanggal) = ?', $currentMonth )
		//->whereRaw("( MONTH(tanggal) = ?, 2 OR MONTH(tanggal) = ?, 3)")
		->whereRaw("(MONTH(tanggal) = {$sesi} OR MONTH(tanggal) = {$sesi}+1 OR MONTH(tanggal) = {$sesi}+2 ) AND YEAR(tanggal) =  2019")
		//->whereRaw('YEAR(tanggal) = ?', 2019 )
		->get();
		print $data;
	}
	public function downloadkdatriwulan()
	{
		$sesi =1;
		$path = "zip/";
		//print $path;
		$zipnama = "triwulan12019.zip";
		$path .= $zipnama;
		//print $path;
		if(file_exists($path)){
		  return response()->download($path);
		}else{
			$data = kda::select('id_kda', 'jenis')
			->whereRaw("(MONTH(tanggal) = {$sesi} OR MONTH(tanggal) = {$sesi}+1 OR MONTH(tanggal) = {$sesi}+2 ) AND YEAR(tanggal) =  2019")
			->get();

			foreach ($data as $id) {
				//print $id->id_kda;
				if ($id->jenis == 1)
				{
					$summernotes = DB::table('summernotes')->where('id',1) ->first();
					$view = view('pdf2', ['summernotes' => $summernotes]);
				}
				elseif ($id->jenis == 2) {
					$summernotes = DB::table('summernotes')->where('id',2) ->first();
					$view = view('pdf2', ['summernotes' => $summernotes]);
				}
				elseif ($id->jenis == 3) {
					$summernotes = DB::table('summernotes')->where('id',3) ->first();
					$view = view('pdf2', ['summernotes' => $summernotes]);
				}
				else {
					$summernotes = DB::table('summernotes')->where('id',4) ->first();
					$view = view('pdf2', ['summernotes' => $summernotes]);
				}
				$html = $view->render();
				$pdf = PDF::loadHTML($html);            
				$sheet = $pdf->setPaper('a4', 'potrait');
				$pdfnama = "file_kda/".$id->id_kda.".pdf";
				$sheet->save($pdfnama);
			}
			$files = glob('kda/*');
			Zipper::make($path)->add($files)->close();

			return response()->download($path);
		}

	}
}
