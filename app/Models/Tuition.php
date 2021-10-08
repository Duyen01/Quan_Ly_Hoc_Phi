<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Major;
use App\Models\Course;



class Tuition extends Model
{
    use HasFactory;
    protected $table = 'tuition';
    public $primaryKey = ['idMajor','idCourse'];
    // public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'idMajor', 'idCourse', 'tuitionNorm'
    ];
    public function major(){
        return $this->belongsTo(Major::class,'id','idMajor');
    }
    public function course(){
        return $this->belongsTo(Course::class,'id', 'idCourse');
    }
    public static function getUnUpdated(){
        
    }
}
