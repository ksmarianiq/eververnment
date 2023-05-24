<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;
    protected $fillable =[
        'nomInv',
        'telephoneInv',
        'emailInv',
        'nbreInv',
        'codeInv',
        'qrCodeInv',
        'enfant',
        'evn_id',
        'ivn_table_id',

    ];
    public function evenement(){
        return $this->belongsTo(Evenement::class,'evn_id','id');
    }
    public function tables(){
        return $this->belongsTo(IvnTables::class,'ivn_table_id','id');
    }
}
