<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IvnTables extends Model
{
    use HasFactory;
    protected $fillable =[
        'nomTableInv',
        'nbrePlaceInv',
        'descriptionTableInv',
        'categorie',
        'evn_id',
    ];
    public function evenement(){
        return $this->belongsTo(Evenement::class,'evn_id','id');
    }
}
