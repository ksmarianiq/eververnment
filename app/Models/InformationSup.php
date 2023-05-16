<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationSup extends Model
{
    use HasFactory;
    protected $fillable =[
        'titre',
        'datetime',
        'infCheckBox',
        'codeInf',
        'qrCodeInf',
        'evn_id'
    ];
    public function evenement(){
        return $this->belongsTo(Evenement::class,'evn_id','id');
    }
}
