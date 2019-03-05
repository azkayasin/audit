<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\TagList;
use App\Temuan;
use App\kda;
use App\kda_keterangan;
use App\kda_data;
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
        
            $kda= new kda;
            $kda->unit = $input['unit'];
            $kda->tanggal = $input['tanggal'];
            $kda->jenis = 1;
            $kda->save();

            $data = new kda_data;
            $data->kda_id = $kda->id_kda;
            $data->item1 = $input['item1'];    
            $data->item1_jum = $input['item1_jum'];
            $data->item1_nom = $input['item1_nom'];
            $data->item2 = $input['item2'];
            $data->item2_jum = $input['item2_jum'];
            $data->item2_nom = $input['item2_nom'];
            $data->item3 = $input['item3'];
            $data->item3_jum = $input['item3_jum'];
            $data->item3_nom = $input['item3_nom'];
            $data->item4 = $input['item4'];
            $data->item4_jum = $input['item4_jum'];
            $data->item4_nom = $input['item4_nom'];
            $data->item5 = $input['item5'];
            $data->item5_jum = $input['item5_jum'];
            $data->item5_nom = $input['item5_nom'];
            $data->item6 = $input['item6'];
            $data->item6_jum = $input['item6_jum'];
            $data->item6_nom = $input['item6_nom'];
            $data->item7 = $input['item7'];
            $data->item7_jum = $input['item7_jum'];
            $data->item7_nom = $input['item7_nom'];
            $data->item8 = $input['item8'];
            $data->item8_jum = $input['item8_jum'];
            $data->item8_nom = $input['item8_nom'];
            $data->item9 = $input['item9'];
            $data->item9_jum = $input['item9_jum'];
            $data->item9_nom = $input['item9_nom'];
            $data->save();
            
            return response()->json(['success'=>'done']);
        
    }

    public function tambahkda2(Request $request)
    {
        $input = $request->all();
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
            $kda->unit = $input['unit'];
            $kda->tanggal = $input['tanggal'];
            $kda->jenis = 2;
            $kda->save();
            $jumlah = count($input['kwitansi']);

            $data = new kda_data;
            $data->kda_id = $kda->id_kda;
            $data->item1 = $input['item1'];    
            $data->item1_jum = $input['item1_jum'];
            $data->item1_nom = $input['item1_nom'];
            $data->item2 = $input['item2'];
            $data->item2_jum = $input['item2_jum'];
            $data->item2_nom = $input['item2_nom'];
            $data->item3 = $input['item3'];
            $data->item3_jum = $input['item3_jum'];
            $data->item3_nom = $input['item3_nom'];
            $data->item4 = $input['item4'];
            $data->item4_jum = $input['item4_jum'];
            $data->item4_nom = $input['item4_nom'];
            $data->item5 = $input['item5'];
            $data->item5_jum = $input['item5_jum'];
            $data->item5_nom = $input['item5_nom'];
            $data->item6 = $input['item6'];
            $data->item6_jum = $input['item6_jum'];
            $data->item6_nom = $input['item6_nom'];
            $data->item7 = $input['item7'];
            $data->item7_jum = $input['item7_jum'];
            $data->item7_nom = $input['item7_nom'];
            $data->item8 = $input['item8'];
            $data->item8_jum = $input['item8_jum'];
            $data->item8_nom = $input['item8_nom'];
            $data->item9 = $input['item9'];
            $data->item9_jum = $input['item9_jum'];
            $data->item9_nom = $input['item9_nom'];
            $data->save();


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
    public function tambahkda3(Request $request)
    {
        $input = $request->all();
        
            $kda= new kda;
            $kda->unit = $input['unit'];
            $kda->tanggal = $input['tanggal'];
            $kda->jenis = $input['jenis_kda3'];
            $kda->save();

            $ket = new kda_keterangan;
            $ket->kondisi = $input['kondisi'];
            $ket->kesimpulan = $input['kesimpulan'];
            $ket->saran = $input['saran'];
            $ket->rekomendasi = $input['rekomendasi'];
            $ket->tanggapan = $input['tanggapan'];
            $ket->kda_id = $kda->id_kda;
            $ket->save();

            return response()->json(['success'=>'done']);
        
    }

    
}