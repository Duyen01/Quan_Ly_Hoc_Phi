<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Admin;
use App\Models\TypePay;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bill';
    public $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = [
        'idStudent', 'idTypePay', 'dateTime', 'money', 'idAdmin', 'note'
    ];
    public function student(){
        return $this->belongsTo(Student::class,'idStudent','id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'idAdmin','id');
    }
    public function typepay(){
        return $this->hasOne(TypePay::class,'idTypePay','id');
    }
   // global scope
   public function scopeSearch($query){
        if($key = request()->key){
            $query = $query->where('firstname', 'like', "%$key%")->orwhere('lastname', 'like', "%$key%");
        }
        return $query;    
    }
}
