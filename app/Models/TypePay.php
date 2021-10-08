<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePay extends Model
{
    use HasFactory;
    protected $table = 'typepay';
    public $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = [
        'typeOfPay', 'begin', 'end','discount'
    ];
    
     public function student(){
        return $this->hasMany(Student::class,'idStudent', 'id');
    }
}
