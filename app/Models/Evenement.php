<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable =[
        'nomEvn',
        'datetime',
        'lieu',
        'codeEvn',
        'qrCodeEvn',
        'org_id'
    ];
    public function organisateur(){
        return $this->belongsTo(Organisateur::class,'org_id','id');
    }
}
