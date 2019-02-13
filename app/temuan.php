<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Temuan extends Model
{
    public $table = "temuan";
    public $fillable = ['name','id_kda','keterangan'];
}