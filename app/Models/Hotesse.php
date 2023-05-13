<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotesse extends Model
{
    use HasFactory;
    protected $fillable =[
        'nomHote',
        'emailHote',
        'telephoneHote',
        'evn_id',
    ];
    public function evenement(){
        return $this->belongsTo(Evenement::class,'evn_id','id');
    }
}
