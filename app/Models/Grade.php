<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Major;
use App\Models\Course;

class Grade extends Model
{
    use HasFactory;
    protected $table = 'grade';
    public $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = [
        'nameGrade'
    ];
    // join 1-n
    public function student(){
        return $this->hasMany(Student::class,'idGrade', 'id');
    }

    public function major(){
        return $this->belongsTo(Major::class,'idMajor', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class,'idCourse', 'id');
    }
}
