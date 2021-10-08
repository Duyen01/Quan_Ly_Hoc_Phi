<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tuition;

class Course extends Model
{
    use HasFactory;
    protected $table = 'course';
    public $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    public function tuition(){
        return $this->hasOne(Tuition::class,'idTuition', 'id');
    }

    public function grade(){
        return $this->hasMany(Grade::class,'idMajor', 'id');
    }
}