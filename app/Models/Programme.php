<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;
    protected $fillable =[
        'libProg',
        'dateProg',
        'heureProg',
        'lieuProg',
        'descriptionProg',
        'evn_id',
        'latitude',
        'longitude',
        'codeProg',
        'qrCodeProg',
    ];
    public function Evenement(){
        return $this->belongsTo(Evenement::class,'evn_id','id');
    }
}
