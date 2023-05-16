<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisateur extends Model
{
    use HasFactory;
    protected $fillable =[
        'nomOrg',
        'num1Org',
        'num2Org',
        'emailOrg',
        'whatsappNum'
    ];
}
