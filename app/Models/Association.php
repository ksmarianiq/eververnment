<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;
    protected $fillable = [
        'hote_id',
        'ivn_table_id'
    ];
    public function hotesse(){
        return $this->belongsTo(Hotesse::class,'hote_id','id');
    }
    public function ivnTables(){
        return $this->belongsTo(ivnTables::class,'ivn_table_id','id');
    }
}
