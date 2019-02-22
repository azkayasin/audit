<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Temuan extends Model
{
    public $table = "temuan";
    public $fillable = ['kwitansi','nominal','keterangan','id_kda','status'];
}