<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kda extends Model
{
    protected $table = 'kda';
    //public $primarykey = 'id_kda';
    protected $primaryKey = 'id_kda';

    protected $fillable =[
    'id_kda',
    'unit',
    'tanggal',
    'jenis',
    ];
}
