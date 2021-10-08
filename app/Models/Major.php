<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $table = 'major';
    public $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = [
        'name','dayAdmission'
    ];
    public function tuition(){
        return $this->hasOne(Tuition::class,'idTuition', 'id');
    }

    public function grade(){
        return $this->hasMany(Grade::class,'idMajor', 'id');
    }
}
