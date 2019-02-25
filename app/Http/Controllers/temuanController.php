<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\TagList;
use App\Temuan;
use App\kda;
use Validator;
use DB;
use PDF;


class temuanController extends Controller
{
    public function buatpdf($id)
    {
        $temuan = DB::table('temuan')->where('kda_id',$id)->get();
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
    
    // public function addMore()
    // {
    //     return view("addMore");
    // }


    // public function addMorePost(Request $request)
    // {
    //     $rules = [];


    //     foreach($request->input('name') as $key => $value) {
    //         $rules["unit.{$key}"] = 'required';
    //         $rules["tanggal.{$key}"] = 'required';
    //         $rules["name.{$key}"] = 'required';
    //     }


    //     $validator = Validator::make($request->all(), $rules);


    //     if ($validator->passes()) {


    //         foreach($request->input('name') as $key => $value) {
    //             TagList::create(['name'=>$value]);
    //         }


    //         return response()->json(['success'=>'done']);
    //     }


    //     return response()->json(['error'=>$validator->errors()->all()]);
    // }

    public function tambah()
    {
        $unit = DB::table('unit')->get();
        $unit1 = DB::table('unit')->get();
        return view("tambah", compact('unit','unit1'));
    }


    public function tambahkda1(Request $request)
    {
        $input = $request->all();
            //print_r($input);
        $rules = [];


        foreach($request->input('kwitansi') as $key => $value) {
            $rules["kwitansi.{$key}"] = 'required';
            $rules["nominal.{$key}"] = 'required';
            $rules["keterangan.{$key}"] = 'required';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes())
        {
            $kda= new kda;
            $kda->unit = $input['unit'][0];
            $kda->tanggal = $input['tanggal'][0];
            $kda->jenis = 2;
            $kda->save();
            $jumlah = count($input['kwitansi']);
            for ($i=0; $i < $jumlah; ++$i) 
            {

                $temuan= new temuan;        
                $temuan->kwitansi = $input['kwitansi'][$i];
                $temuan->nominal= $input['nominal'][$i];
                $temuan->keterangan= $input['keterangan'][$i];
                $temuan->kda_id= $kda->id_kda;
                $temuan->save();  
            }
            //return print_r($input);
            return response()->json(['success'=>'done']);            
        }
        return response()->json(['error'=>$validator->errors()->all()]);

        //     foreach($request->input('name') as $key => $value) {
        //         Temuan::create(['name'=>$value, 'id_kda'=>1,'keterangan'=>$value]);
        //     }


        //     return response()->json(['success'=>'done']);
        // }


        // return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function tambahkda2(Request $request)
    {
        $input = $request->all();
        
            $kda= new kda;
            $kda->unit = $input['unit1'][0];
            $kda->tanggal = $input['tanggal'][0];
            $kda->jenis = 1;
            $kda->save();
            return response()->json(['success'=>'done']);
        
    }
    
}