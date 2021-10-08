<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scholarship;
use App\Models\TypePay;
use App\Models\Grade;
class Student extends Model
{
    use HasFactory;
    protected $table = 'student';
    public $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = [
        'firstname', 'lastname','gender', 'idGrade', 'idScholarship', 'idTypePay', 'email', 'password',' status','phone','dob','address'
    ];
    // join 1-1
    public function grade(){
        return $this->hasOne(Grade::class,'id', 'idGrade');
    }
    public function scholarships(){
        return $this->hasOne(Scholarship::class,'id', 'idScholarship');
    }
    public function typeofpay(){
        return $this->hasOne(TypePay::class,'id', 'idTypePay');
    }

    public function getFullNameAttribute()
    {
        return $this->lastName . ' ' . $this->firstName;
    }
     public function scopeSearch($query){
        if($key = request()->key){
            $query = $query->where('firstname', 'like', "%$key%")->orwhere('lastname', 'like', "%$key%");
        }
        return $query;    
    }
}
